<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use FuturSport\Model\CategoriesTable;
use FuturSport\Model\Categories;
use FuturSport\Form\CategoriesForm;

class AdminCategoriesController extends AbstractActionController {

    private $categoriesTable;

    public function __construct(CategoriesTable $categoriesTable) {
        $this->categoriesTable = $categoriesTable;
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
            return ['categories' => $this->categoriesTable->getAllRowsOrd()];
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }

    public function addAction() {
        if ($this->access()->isAdmin()) {
            $form = new CategoriesForm();
            $form->get('submit')->setValue('Agregar Categoria');

            $request = $this->getRequest();
            if (!$request->isPost()) {
                return ['form' => $form];
            }

            $categoria = new Categories();
            $form->setInputFilter($categoria->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return ['form' => $form];
            }

            $categoria->exchangeArray($form->getData());
            $this->categoriesTable->saveCategoria($categoria);
            $this->redirect()->toRoute('admin-categories');
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }

    public function updateAction() {
        if ($this->access()->isAdmin()) {
            $id = (int) $this->params()->fromRoute('id', 0);

            if (0 === $id) {
                return $this->redirect()->toRoute('admin-categories');
            }
            try {
                $categoria = $this->categoriesTable->getCategoria($id);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('admin-categories', ['action' => 'index']);
            }
            $form = new CategoriesForm();
            $form->bind($categoria);
            $form->get('submit')->setAttribute('value', 'Modificar categoria');

            $request = $this->getRequest();

            $viewData = ['id' => $id, 'form' => $form];

            if (!$request->isPost()) {
                return $viewData;
            }

            $form->setInputFilter($categoria->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return $viewData;
            }

            $this->categoriesTable->saveCategoria($categoria);


            return $this->redirect()->toRoute('admin-categories', ['action' => 'index']);
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

            if ($this->categoriesTable->deleteCategoria($id)) {
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

