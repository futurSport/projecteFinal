<?php
namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use FuturSport\Model\RelationsTable;



class RelationsController extends AbstractActionController {

    private $relationsTable;

    public function __construct(RelationsTable $relationsTable) {
        $this->relationsTable = $relationsTable;
    }
    public function fanAction(){
        if($this->access()->logat()){
            $view = new ViewModel();
            $view->setTerminal(true);

            $user_pichichi = (int) $this->params()->fromRoute('id', 0);
            $user_fan=$this->access()->idUser();
            if ($user_pichichi == 0) {
                echo "0";
            } else {
                if($this->relationsTable->fan($user_pichichi, $user_fan)){
                    echo "1";
                }
                else{
                    echo "0";
                }
            }
            return $view;
        }
        else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    public function deixaAction(){
        if($this->access()->logat()){
            $view = new ViewModel();
            $view->setTerminal(true);

            $user_pichichi = (int) $this->params()->fromRoute('id', 0);
            $user_fan=$this->access()->idUser();
            if ($user_pichichi == 0) {
                echo "0";
            } else {
                if($this->relationsTable->deixa($user_pichichi, $user_fan)){
                    echo "1";
                }
                else{
                    echo "0";
                }
            }
            return $view;
        }
        else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
}