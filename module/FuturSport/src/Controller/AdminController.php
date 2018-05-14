<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class AdminController extends AbstractActionController{
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
        
         return ['missatge' => 'Ha entrat a la zona d\'administracio'];
      
    }
}
