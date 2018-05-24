<?php

namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use FuturSport\Model\ProvinciesTable;
use FuturSport\Model\Provincies;
use FuturSport\Form\ProvinciesForm;

class AdminProvinciesController extends AbstractActionController {

    private $provinciesTable;

    public function __construct(ProvinciesTable $provinciesTable) {
        $this->provinciesTable = $provinciesTable;
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
            return ['provincies' => $this->provinciesTable->getAllRowsOrd()];
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }

    public function addAction() {
        if ($this->access()->isAdmin()) {
            $form = new ProvinciesForm();
            $form->get('submit')->setValue('Agregar Província');

            $request = $this->getRequest();
            if (!$request->isPost()) {
                return ['form' => $form];
            }

            $provincia = new Provincies();
            $form->setInputFilter($provincia->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return ['form' => $form];
            }

            $provincia->exchangeArray($form->getData());
            $this->provinciesTable->saveProvincia($provincia);
            $this->redirect()->toRoute('admin-provincies');
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }

    public function updateAction() {
        if ($this->access()->isAdmin()) {
            $id = (int) $this->params()->fromRoute('id', 0);

            if (0 === $id) {
                return $this->redirect()->toRoute('admin-provincies');
            }
            try {
                $provincia = $this->provinciesTable->getProvincia($id);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('admin-provincies', ['action' => 'index']);
            }
            $form = new ProvinciesForm();
            $form->bind($provincia);
            $form->get('submit')->setAttribute('value', 'Modificar província');

            $request = $this->getRequest();

            $viewData = ['id' => $id, 'form' => $form];

            if (!$request->isPost()) {
                return $viewData;
            }

            $form->setInputFilter($provincia->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return $viewData;
            }

            $this->provinciesTable->saveProvincia($provincia);


            return $this->redirect()->toRoute('admin-provincies', ['action' => 'index']);
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
                $this->redirect()->toRoute('admin-provincies');
            }

            if ($this->provinciesTable->deleteProvincia($id)) {
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