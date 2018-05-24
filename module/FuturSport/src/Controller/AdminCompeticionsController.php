<?php

namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use FuturSport\Model\CompeticionsTable;
use FuturSport\Model\Competicions;
use FuturSport\Form\CompeticionsForm;




class AdminCompeticionsController extends AbstractActionController {
     private $competicionsTable;

    public function __construct(CompeticionsTable $competicionsTable) {
        $this->competicionsTable = $competicionsTable;
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
            return ['competicions' => $this->competicionsTable->getAllRowsOrd()];
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    public function addAction(){
        if ($this->access()->isAdmin()) {
            $form = new CompeticionsForm();
            $form->get('submit')->setValue('Agregar Competicio');

            $request = $this->getRequest();
            if (!$request->isPost()) {
                return ['form' => $form];
            }

            $competicio = new Competicions();
            $form->setInputFilter($competicio->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return ['form' => $form];
            }

            $competicio->exchangeArray($form->getData());
            $this->competicionsTable->saveCompeticio($competicio);
            $this->redirect()->toRoute('admin-competicions');
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    public function updateAction(){
        if ($this->access()->isAdmin()) {
            $id = (int) $this->params()->fromRoute('id', 0);

            if (0 === $id) {
                return $this->redirect()->toRoute('admin-competicions');
            }
            try {
                $competicions = $this->competicionsTable->getCompeticio($id);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('admin-categories', ['action' => 'index']);
            }
            $form = new CompeticionsForm();
            $form->bind($competicions);
            $form->get('submit')->setAttribute('value', 'Modificar competició');

            $request = $this->getRequest();

            $viewData = ['id' => $id, 'form' => $form];

            if (!$request->isPost()) {
                return $viewData;
            }

            $form->setInputFilter($competicions->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return $viewData;
            }

            $this->competicionsTable->saveCompeticio($competicions);


            return $this->redirect()->toRoute('admin-competicions', ['action' => 'index']);
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
                $this->redirect()->toRoute('admin-categories');
            }

            if ($this->competicionsTable->deleteCompeticio($id)) {
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

    
    
}
