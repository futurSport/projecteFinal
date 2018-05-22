<?php

namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use FuturSport\Model\RolTable;
use FuturSport\Model\UsersTable;
use FuturSport\Model\Users;


use Zend\Session\Container;
use Zend\Session\SessionManager; 

use Zend\Crypt\Password\Bcrypt;

class IndexController extends AbstractActionController
{
    private $table;
    private $sessionContainer;
    private $sessionManager;
    private $rolTable;
    
    public function __construct(UsersTable $table,RolTable $rolTable,$sessionContainer) {
        $this->table=$table;
        $this->rolTable=$rolTable;
        $this->sessionContainer=$sessionContainer;
        $sessionManager=new SessionManager;
        $this->sessionManager=$sessionManager;
        
    }
    
    public function indexAction()
    {
        
        if(!isset($_SESSION['usuariConectat'])){             
            
            $rols=$this->getRolsforSelect();
           
            $request = $this->getRequest();
            
            if ($request->isPost()) {
                $formData=$request->getPost();
                if($formData['form']=="formLogin"){
                    $username=$formData['email'];
                    $password=$formData['password'];
                    
                    $entrar=$this->table->getUserRegister($username);
                    
                    $bcrypt=new Bcrypt();

                    if (!empty($entrar) && $bcrypt->verify($password, $entrar['password'])) {
                        $this->createSession($entrar);
                    }
                    else{
                       return ['rols'=>$rols,
                               'messageLogin'=>'Usuari Incorrecte',
                               'messageRegister'=>'']; 
                    }
                }
                else if($formData['form']=="formRegitrar"){
                    $username=$formData['email'];
                    $password=$formData['password'];
                    $name=$formData['name'];
                    $surname=$formData['surname'];
                    $rol_id=$formData['rol_id'];
                    $estaRegitrat=$this->table->getUserRegister($username);
                    if(empty($estaRegitrat)){
                        $user=new Users($username, $password, $name, $surname, $rol_id);
                        $this->table->newUser($user);
                        $entrar=$this->table->getUserRegister($username);
                        if(!empty($entrar)){
                            echo "Entro";
                            $this->createSession($entrar);
                        }
                        else{
                            return ['rols'=>$rols,
                              'messageLogin'=>'',
                               'messageRegister'=>'Error al registrar-se']; 
                        }
                       
                    }
                    else{
                          return ['rols'=>$rols,
                              'messageLogin'=>'',
                               'messageRegister'=>'L\'e-mail ja existeix']; 
                       }
                    
                }
                
                
            } 
            else{
                return ['rols'=>$rols,
                        'messageLogin'=>'',
                        'messageRegister'=>'']; 
            }
        }      
        else{
            
             $this->redirect()->toRoute($this->access()->checkAccess());
        }
        
    }
    public function logoutAction(){
        $this->access()->destroySession();
        $this->redirect()->toRoute('index');
    }
    
     public function getRolsforSelect(){
        $rols=$this->rolTable->fetchAll();
        $role=[];
        foreach($rols as $rol){
            if($rol->name!='admin'){
                array_push($role, $rol);
            }
        }
        return $role;
    }
    public function createSession($user){
        $sessionContainer = new Container('usuariConectat');
        $sessionContainer->id = $user['id'];
        $sessionContainer->rol_name = $user['rol_name'];
        $sessionContainer->name = $user['name'];
        $sessionContainer->surname = $user['surname'];
        $this->redirect()->toRoute($this->access()->checkAccess());
    }
}
