<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use FuturSport\Model\ProvinciesTable;
use FuturSport\Model\ComarquesTable;
use FuturSport\Model\Comarques;
use FuturSport\Form\ComarquesForm;



class AdminComarquesController extends AbstractActionController {

    private $provinciesTable;
    private $comarquesTable;

    public function __construct(ProvinciesTable $provinciesTable, ComarquesTable $comarquesTable) {
        $this->provinciesTable = $provinciesTable;
        $this->comarquesTable = $comarquesTable;
    }

    public function onDispatch(MvcEvent $e) {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);

        // Set alternative layout
        $this->layout()->setTemplate('layout/admin-layout');

        // Return the response
        return $response;
    }

    public function indexAction() {
        if ($this->access()->isAdmin()) {
            return ['comarques' => $this->comarquesTable->getAllRowsOrd()];
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    public function addAction() {
        if ($this->access()->isAdmin()) {
            $form = new ComarquesForm();
            $form->get('submit')->setValue('Agregar Comarca');
            $id_provincies = $this->getProvinciesSelect();
            $form->get('id_provincia')->setValueOptions($id_provincies);

            $request = $this->getRequest();
            if (!$request->isPost()) {
                return ['form' => $form];
            }

            $comarca = new Comarques();
            $form->setInputFilter($comarca->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return ['form' => $form];
            }

            $comarca->exchangeArray($form->getData());
            $this->comarquesTable->saveComarca($comarca);
            $this->redirect()->toRoute('admin-comarques');
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    
    public function updateAction(){
         if ($this->access()->isAdmin()) {
            $id = (int) $this->params()->fromRoute('id', 0);

            if (0 === $id) {
                return $this->redirect()->toRoute('admin-comarques');
            }
            try {
                $comarca = $this->comarquesTable->getComarca($id);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('admin-comarques', ['action' => 'index']);
            }
            $form = new ComarquesForm();
            $form->bind($comarca);
            $form->get('submit')->setAttribute('value', 'Modificar comarca');
            $id_provincies = $this->getProvinciesSelect();
            $form->get('id_provincia')->setValueOptions($id_provincies);

            $request = $this->getRequest();

            $viewData = ['id' => $id, 'form' => $form];

            if (!$request->isPost()) {
                return $viewData;
            }

            $form->setInputFilter($comarca->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return $viewData;
            }

            $this->comarquesTable->saveComarca($comarca);


            return $this->redirect()->toRoute('admin-comarques', ['action' => 'index']);
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    
    public function deleteAction() {
        
        if ($this->access()->isAdmin()) {
            $view = new ViewModel();
            $view->setTerminal(true);

            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                $this->redirect()->toRoute('admin-comarques');
            }

           if ($this->comarquesTable->deleteComarca($id)) {
                echo "1";
            } else {
                echo "0";
            }

            return $view;
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
        
    }

    public function getProvinciesSelect(){
        $provincies=$this->provinciesTable->getAllRowsOrd();
        $provin['']='-Seleccioni una provinica-';
        foreach($provincies as $provincia){
            
            $key=$provincia->id;
            $provin[$key]=$provincia->name;
        }
        return $provin;
    }
}