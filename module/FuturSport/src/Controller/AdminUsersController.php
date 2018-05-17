<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use FuturSport\Model\UsersTable;
use FuturSport\Model\RolTable;
use FuturSport\Form\UsersForm;
use FuturSport\Model\Users;

class AdminUsersController extends AbstractActionController{
    private $usersTable;
    private $rolTable;
    public function __construct(UsersTable $userTable, RolTable $rolTable ) {
        $this->usersTable=$userTable;
        $this->rolTable=$rolTable;
    } 
    
    
    public function onDispatch(MvcEvent $e) 
  {
    // Call the base class' onDispatch() first and grab the response
    $response = parent::onDispatch($e);        
	
    // Set alternative layout
    $this->layout()->setTemplate('layout/admin-layout');                
	
    // Return the response
    return $response;
  }
    public function indexAction(){
        if($this->access()->isAdmin()){
         return ['users' =>$this->usersTable->getAllRows()];
        }
        else{
           $this->access()->destroySession();
           return $this->redirect()->toRoute('index'); 
        }
    }
    public function addAction(){
       if($this->access()->isAdmin()){
            $form = new UsersForm();
            $form->get('submit')->setValue('Agregar Usuari');
            $rol=$this->getRolsforSelect();
            $form->get('rol_id')->setValueOptions($rol);
            $request = $this->getRequest();
            if (! $request->isPost()) {
                return ['form' => $form];
            }

            $user = new Users();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if (! $form->isValid()) {
                return ['form' => $form];
            }

            $user->exchangeArray($form->getData());
            $this->usersTable->saveUser($user);
            return $this->redirect()->toRoute('admin-users'); 
           }
           else{
              $this->access()->destroySession();
              return $this->redirect()->toRoute('index');   
           }
    }
    public function updateAction(){
        if($this->access()->isAdmin()){
            $id = (int) $this->params()->fromRoute('id', 0);

            if (0 === $id) {
                return $this->redirect()->toRoute('admin-users');
            }
            try {
                $user = $this->usersTable->getUser($id);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('admin-users', ['action' => 'index']);
            }
            $form = new UsersForm();
            $form->bind($user);
            $form->get('submit')->setAttribute('value', 'Modificar Usuari');
            $rol=$this->getRolsforSelect();
            $form->get('rol_id')->setValueOptions($rol);
            $request = $this->getRequest();
            
            $viewData = ['id' => $id, 'form' => $form];

            if (! $request->isPost()) {
                return $viewData;
            }

            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if (! $form->isValid()) {
                return $viewData;
            }

            $this->usersTable->saveUser($user);

            
            return $this->redirect()->toRoute('admin-users', ['action' => 'index']);    
        }
        else{
              $this->access()->destroySession();
              return $this->redirect()->toRoute('index');   
           }
    }
    
    
    
    
    
     public function getRolsforSelect(){
        $rols=$this->rolTable->fetchAll();
        foreach($rols as $rol){
            
            $key=$rol->id;
            $role[$key]=$rol->name;
        }
        return $role;
    }
}