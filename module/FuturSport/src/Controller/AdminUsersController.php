<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use FuturSport\Model\UsersTable;

class AdminUsersController extends AbstractActionController{
     private $table;
    
    public function __construct(UsersTable $table) {
        $this->table=$table;
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
         return ['missatge' => 'Ha entrat a la zona d\'usuaris',
                 'users' =>$this->table->getAllRows()
             ];
        }
        else{
           $this->access()->destroySession();
           return $this->redirect()->toRoute('index'); 
        }
    }
    public function addAction(){
        return ['missatge' => 'Ha entrat a la zona de creació d\'usuaris',
             ];
    }
}