<?php

namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use FuturSport\Model\UsersTable;
use FuturSport\Model\Users;
use FuturSport\Form\UsersForm; 

class IndexController extends AbstractActionController
{
    private $table;
    
    public function __construct(UsersTable $table) {
        $this->table=$table;
    }
    
    public function indexAction()
    {
       
    }
}
