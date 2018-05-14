<?php

namespace FuturSport\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class AccessPlugin extends AbstractPlugin{
    
    public function checkAccess(){
        if($_SESSION['usuariConectat']->rol_name=='admin'){
            return 'admin';
        }
        else{
            return 'camp';
        }
    }
}

