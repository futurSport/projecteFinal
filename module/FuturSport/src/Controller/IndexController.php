<?php

namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use FuturSport\Model\UsersTable;
use FuturSport\Model\Users;
use FuturSport\Form\UsersForm; 

use Zend\Session\Container;
use Zend\Session\SessionManager; 

use Zend\Crypt\Password\Bcrypt;

class IndexController extends AbstractActionController
{
    private $table;
    private $sessionContainer;
    private $sessionManager;
    public function __construct(UsersTable $table,$sessionContainer) {
        $this->table=$table;
        $this->sessionContainer=$sessionContainer;
        $sessionManager=new SessionManager;
        $this->sessionManager=$sessionManager;
        
    }
    
    public function indexAction()
    {
        if(!isset($_SESSION['usuariConectat'])){ 
            $request = $this->getRequest();
            if($request->isPost()){
                $formData=$request->getPost();
            

                $username=$formData['email'];
                $password=$formData['password'];
            
           
                $entrar=$this->table->getUserRegister($username);
                $bcrypt=new Bcrypt();

                if ($bcrypt->verify($password, $entrar['password'])) {
                    $sessionContainer = new Container('usuariConectat');
                    $sessionContainer->id = $entrar['id'];
                    $sessionContainer->rol_name = $entrar['rol_name'];
                    $sessionContainer->name = $entrar['name'];
                    $sessionContainer->surname = $entrar['surname'];


                    return $this->redirect()->toRoute($this->access()->checkAccess());

                }
           }    
            else{
               return new ViewModel([
                    'message' => 'Per no redirigir',
                ]);
            }
        }else{
             return $this->redirect()->toRoute($this->access()->checkAccess());
        }
        
    }
    public function logoutAction(){
        $this->access()->destroySession();
        return $this->redirect()->toRoute('index');
    }
}
