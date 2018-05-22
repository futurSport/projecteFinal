<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use FuturSport\Model\UsersTable;
use FuturSport\Model\ProfilesTable;


use Zend\View\Model\ViewModel;

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
    public function searchAction(){
        $view = new ViewModel();
        $view->setTerminal(true);
        $search=(string) $this->params()->fromRoute('busqueda', '');
        
        if($search!=''){
            $resultats=$this->userTable->getAllRows($search);
            $jsonResultat=[];
            foreach($resultats as $resultat){
                if($resultat['rol_name']!='admin' && $resultat['id']!=$this->access()->idUser()){
                    array_push($jsonResultat,  array('id'=>$resultat['id'],'name'=>utf8_encode($resultat['name']),'surname'=>utf8_encode($resultat['surname'])));
                }
                
            }
           
            
             echo json_encode($jsonResultat);
        }
        
        return $view;
    }
}
