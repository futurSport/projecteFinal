<?php

namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use FuturSport\Model\UsersTable;
use FuturSport\Model\Users;
use FuturSport\Form\UsersForm; 

use Zend\Session\SessionManager;

class IndexController extends AbstractActionController
{
    private $table;
    
    public function __construct(UsersTable $table) {
        $this->table=$table;
    }
    
    public function indexAction()
    {
        $form=new UsersForm();
        $form->get('submit')->setValue('Inicia sessió');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }
        $user=new Users();
        $form->setInputFilter($user->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }
        
        //echo "<pre>";print_r($user); echo "</pre>";
        
        $user->exchangeArray($form->getData());
        
        $entrar=$this->table->getUser($user);
        if(!empty($entrar)){
            echo "<pre>";print_r($entrar); echo "</pre>";
            
        }
        else{
            return $this->redirect()->toRoute('index');
        }
         
    }
}
