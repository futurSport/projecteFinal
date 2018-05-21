<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use FuturSport\Model\UsersTable;
use FuturSport\Model\ProfilesTable;


;

class CampController extends AbstractActionController{
    private $userTable;
    private $profilesTable;
    
    public function __construct(UsersTable $userTable, ProfilesTable $profilesTable) {
       $this->userTable=$userTable;
       $this->profilesTable=$profilesTable;
    }
    public function indexAction(){
        $idUser=$this->access()->idUser();
        if($idUser!=0){
            if($this->profilesTable->getPerfilUser($idUser)){
                
            }
            else{
                $this->redirect()->toRoute('profile', array(
                    'controller' => 'profile',
                    'action' =>  'first-profile',
                    'id' =>$idUser ));
            }
       }
        else{
            $this->redirect()->toRoute('index');
        }
    }
}
