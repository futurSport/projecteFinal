<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use FuturSport\Model\UsersTable;
//use FuturSport\Model\Users;
//use FuturSport\Form\UsersForm; 

use Zend\Session\Container;

class CampController extends AbstractActionController{
    public function indexAction(){
        $idUser=$this->access()->logat();
        if($idUser!=0){
            
        }
        else{
            $this->redirect()->toRoute('index');
        }
    }
}
