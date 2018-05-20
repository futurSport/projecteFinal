<?php

namespace FuturSport\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use FuturSport\Form\ProfileForm;
use FuturSport\Model\ProfilesTable;
use FuturSport\Model\Profiles;
use FuturSport\Model\ProvinciesTable;
use FuturSport\Model\ComarquesTable;

class ProfileController extends AbstractActionController {
    private $profileTable;
    private $provinciesTable;
    private $comarquesTable;
    
    public function __construct(ProfilesTable $profileTable, ProvinciesTable $provinciesTable, ComarquesTable $comarquesTable) {
        $this->profileTable=$profileTable;
        $this->provinciesTable=$provinciesTable;
        $this->comarquesTable=$comarquesTable;
    }
    
    public function FirstProfileAction() {
        $idUser = (int) $this->params()->fromRoute('id', 0);
        if ($idUser > 0) {
            $form = new ProfileForm();
            $form->get('submit')->setValue('Actualitzar Perfil');
            $form->get('id_user')->setValue($idUser);
            $provincies = $this->getProvinciesforSelect();
            $form->get('id_provincia')->setValueOptions($provincies);
            $request = $this->getRequest();
            if (!$request->isPost()) {
                return ['form' => $form,
                        'id_user'=>$idUser];
            }

            $profileUser = new Profiles();
            $form->setInputFilter($profileUser->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return ['form' => $form,
                    'id_user'=>$idUser];
            }
            else{
                 $view = new ViewModel();
                $view->setTerminal(true);
                $profileUser->exchangeArray($form->getData());
                echo "<pre>";
                print_r($profileUser);
                echo "</pre>";
                return $view;
                //$this->profileTable->saveProfile($profileUser);
                //$this->redirect()->toRoute('camp');
            }
        } else {
            //$this->access()->destroySession();
            //$this->redirect()->toRoute('index');
        }
    }
    public function getProvinciesforSelect(){
        $provincies=$this->provinciesTable->fetchAll();
        $provin['']='-Seleccioni una provinica-';
        foreach($provincies as $provincia){
            
            $key=$provincia->id;
            $provin[$key]=$provincia->name;
        }
        return $provin;
    }
    public function selectComarquesAction(){
        $view = new ViewModel();
        $view->setTerminal(true);
        
        $id_provincia = (int) $this->params()->fromRoute('id', 0);
        if ($id_provincia==0) {
            echo "0";
        }
        else{
            $comarques=$this->comarquesTable->getComarques($id_provincia);
            $jsonComar=[];

            array_push($jsonComar,array('', '-Seleccioni una comarca-'));
            foreach($comarques as $comarca){

                array_push($jsonComar,  array($comarca->id, utf8_encode($comarca->name)));
            }

            echo json_encode($jsonComar);
        }
        return $view;
    }
   

}
