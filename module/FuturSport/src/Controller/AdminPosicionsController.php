<?php

namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use FuturSport\Model\PosicionsTable;
use FuturSport\Model\Posicions;
use FuturSport\Form\PosicionsForm;

class AdminPosicionsController extends AbstractActionController {

    private $posicionsTable;

    public function __construct(PosicionsTable $posicionsTable) {
        $this->posicionsTable = $posicionsTable;
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
            return ['posicions' => $this->posicionsTable->fetchAll()];
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    public function addAction() {
        if ($this->access()->isAdmin()) {
            $form = new PosicionsForm();
            $form->get('submit')->setValue('Agregar Posició');

            $request = $this->getRequest();
            if (!$request->isPost()) {
                return ['form' => $form];
            }

            $posicio = new Posicions();
            $form->setInputFilter($posicio->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return ['form' => $form];
            }

            $posicio->exchangeArray($form->getData());
            $this->posicionsTable->savePosicio($posicio);
            $this->redirect()->toRoute('admin-posicions');
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    public function updateAction() {
        if ($this->access()->isAdmin()) {
            $id = (int) $this->params()->fromRoute('id', 0);

            if (0 === $id) {
                return $this->redirect()->toRoute('admin-posicions');
            }
            try {
                $posicio = $this->posicionsTable->getPosicio($id);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('admin-posicions', ['action' => 'index']);
            }
            $form = new PosicionsForm();
            $form->bind($posicio);
            $form->get('submit')->setAttribute('value', 'Modificar posicio');

            $request = $this->getRequest();

            $viewData = ['id' => $id, 'form' => $form];

            if (!$request->isPost()) {
                return $viewData;
            }

            $form->setInputFilter($posicio->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return $viewData;
            }

            $this->posicionsTable->savePosicio($posicio);


            return $this->redirect()->toRoute('admin-posicions', ['action' => 'index']);
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

            if ($this->posicionsTable->deleteProvincia($id)) {
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
