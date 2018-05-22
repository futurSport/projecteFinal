<?php

namespace FuturSport\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use FuturSport\Form\ProfileForm;
use FuturSport\Model\ProfilesTable;
use FuturSport\Model\UsersTable;
use FuturSport\Model\Profiles;
use FuturSport\Model\ProvinciesTable;
use FuturSport\Model\ComarquesTable;



class ProfileController extends AbstractActionController {
    private $profileTable;
    private $provinciesTable;
    private $comarquesTable;
    private $usersTable;
    
    public function __construct(ProfilesTable $profileTable, ProvinciesTable $provinciesTable, ComarquesTable $comarquesTable, UsersTable $usersTable) {
        $this->profileTable=$profileTable;
        $this->provinciesTable=$provinciesTable;
        $this->comarquesTable=$comarquesTable;
        $this->usersTable=$usersTable;
    }
    
    public function FirstProfileAction() {
        $idUser = (int) $this->params()->fromRoute('id', 0);
        if($this->access()->logat()){
            if ($idUser > 0) {
                if($this->profileTable->getPerfilUser($idUser)==false){
                    $form = new ProfileForm();
                    $form->get('submit')->setValue('Actualitzar Perfil');
                    $form->get('id_user')->setValue($idUser);
                    $provincies = $this->getProvinciesforSelect();
                    $form->get('id_provincia')->setValueOptions($provincies);
                    $comarca['']="-Selccioni una comarca-";
                    $form->get('id_comarca')->setValueOptions($comarca);
                    $request = $this->getRequest();
                    if (!$request->isPost()) {
                        return ['form' => $form,
                                'id_user'=>$idUser];
                    }
                    $post = array_merge_recursive(
                        $request->getPost()->toArray(),
                        $request->getFiles()->toArray()
                    );
                    $profileUser = new Profiles();
                    $form->setInputFilter($profileUser->getInputFilter());
                    $form->setData($post);

                    if (!$form->isValid()) {
                        return ['form' => $form,
                            'id_user'=>$idUser];
                    }
                    $data=$form->getData();
                    $data=$this->tractarArray($data);
                    $profileUser->exchangeArray($data);
                    $this->profileTable->saveProfile($profileUser);

                }
                    $this->redirect()->toRoute('camp');
            }
            else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
        }
        else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }
    
    public function profileAction(){
        $idUser = (int) $this->params()->fromRoute('id', 0);
        if($this->access()->logat()!=0){
            if ($idUser > 0) {
                $profile=$this->profileTable->getPerfilUser($idUser);
                if($profile==false){
                     $this->redirect()->toRoute('profile', array(
                    'controller' => 'profile',
                    'action' =>  'first-profile',
                    'id' =>$idUser ));
                }
                else{
                   $user=$this->usersTable->getUser($idUser);
                   return ['user'=>$user,
                            'profile'=>$profile];
                   
                }
            }
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
            if($comarques==''){
                echo 0;
            }
            $jsonComar=[];

            array_push($jsonComar,  array("", "-Seleccioni una comarca-"));
            foreach($comarques as $comarca){

                array_push($jsonComar,  array($comarca->id, utf8_encode($comarca->name)));
            }

            echo json_encode($jsonComar);
        }
        return $view;
    }
   
    public function tractarArray($data){
        
        $this->thumbjpeg($data['photo'], 230, $data['id_user']); 
        $data['photo']=getcwd().'\public\img\\'.$data['id_user'].'\\'.$data['photo']['name'];
        
        
        return $data;
        
    }
    function thumbjpeg($imagen,$altura, $id_user) { 
        // Lugar donde se guardarán los thumbnails respecto a la carpeta donde está la imagen "grande". 
        
        // Prefijo que se añadirá al nombre del thumbnail. Ejemplo: si la imagen grande fuera "imagen1.jpg", 
        // el thumbnail se llamaría "tn_imagen1.jpg" 
      

        // Aquí tendremos el nombre de la imagen. 
        $nombre = $imagen['name'];  
        $rootPath = getcwd();
        
        // Aquí la ruta especificada para buscar la imagen. 
        $camino =$rootPath.'\public\img\\'.$id_user;
        $caminoImagen=$camino .'\\'.$nombre;
        // Intentamos crear el directorio de thumbnails, si no existiera previamente. 
        if (!file_exists($camino)){
            mkdir($camino);
            
        }
            

        // Aquí comprovamos que la imagen que queremos crear no exista previamente 
        if (!file_exists($caminoImagen)) {
            
            $img = imagecreatefromjpeg($imagen['tmp_name']) or die("No se encuentra la imagen $camino$nombre<br>\n");

            // miramos el tamaño de la imagen original... 
            $datos = getimagesize($imagen['tmp_name']) or die("Problemas con $camino$nombre<br>\n");

            // intentamos escalar la imagen original a la medida que nos interesa 
            $ratio = ($datos[1] / $altura);
            $anchura = 230;

            // esta será la nueva imagen reescalada 
            $rezise = imagecreatetruecolor($anchura, $altura);

            // con esta función la reescalamos 
            imagecopyresampled($rezise, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);

            // voilà la salvamos con el nombre y en el lugar que nos interesa. 
            imagejpeg($rezise, $caminoImagen);
            
        }
    }
    
    
    

}
