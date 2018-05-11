<?php

namespace FuturSport\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\Container;
class AccessPlugin extends AbstractPlugin{
    
    public function checkAccess(){
        
       echo "<pre>"; print_r($sessionContainer); echo "</pre>";
       /* if($sessionContainer->rol_name=='administrador'){
            return 'camp';
        }
        else{
            return 'index';
        }*/
    }
}

