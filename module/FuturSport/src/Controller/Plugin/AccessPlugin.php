<?php

namespace FuturSport\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\SessionManager;


class AccessPlugin extends AbstractPlugin{
    private $sessionContainer;
    private $sessionManager;
    /**
     * Constructor. Its goal is to inject dependencies into controller.
     */
    public function __construct($sessionContainer) 
    {
        $this->sessionContainer = $sessionContainer;
        $sessionManager=new SessionManager;
        $this->sessionManager=$sessionManager;
    }
    
    public function checkAccess(){
       
        if(isset($_SESSION['usuariConectat'])){
            if($this->sessionContainer->rol_name=='admin'){
                return 'admin';
            }
            else{
                return 'camp';
            }
           
        }
        else{
            return 'index';
        }
    }
    public function isAdmin(){
        $session=new SessionManager();
        $session->start();
        if($session->sessionExists()){
            if($_SESSION['usuariConectat']->rol_name=='admin'){
                    return true;
                }
            else{
                    return false;
            }
        }
    }
    public function destroySession(){
        if($this->sessionManager->sessionExists()){
           return $this->sessionManager->destroy();
        }
    }
}

