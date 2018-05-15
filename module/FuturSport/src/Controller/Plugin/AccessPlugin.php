<?php

namespace FuturSport\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\SessionManager;
class AccessPlugin extends AbstractPlugin{
    
    public function checkAccess(){
        $session=new SessionManager();
        $session->start();
        
        if($_SESSION['usuariConectat']->rol_name=='admin'){
            return 'admin';
        }
        else{
            return 'camp';
        }
    }
}

