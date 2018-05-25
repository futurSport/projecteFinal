<?php

namespace FuturSport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use FuturSport\Model\NewsTable;

class NewsController extends AbstractActionController{
    
    private $newsTable;
    
    public function __construct(NewsTable $newsTable) {
       $this->newsTable=$newsTable;
    }
    public function saveNewAction(){
        $id_user=$this->params()->fromRoute('id', 0);
        if($this->access()->logat() && $id_user==$this->access()->idUSer()){
            $request = $this->getRequest();
            $data=$request->getPost();
            $body=$data['cosNoticia'];
            
            $img=$this->tractarfoto($_FILES['file'], $id_user);
            $url=explode('https://www.youtube.com/watch?v=', $data['url']);
            if(!empty($body) || !empty($img) || !empty($url[1])){
                $this->newsTable->saveNew($id_user, $body, $img, $url[1]);
            }
            
            $this->redirect()->toRoute('profile', ['action'=>'profile', 'id'=>$id_user]);
        }
        else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
        
    }
    
     public function tractarfoto($photo, $id_user) {
        if (!empty($photo['name'])) {

            $this->thumbjpeg($photo, 600, $id_user);
            $photo = '/img/news/' . $id_user.$photo['name'];
        } else {
            $photo = null;
        }

        return $photo;
    }
    
    
    function thumbjpeg($imagen, $amplada, $id_user) {
        // Lugar donde se guardarán los thumbnails respecto a la carpeta donde está la imagen "grande". 
        // Prefijo que se añadirá al nombre del thumbnail. Ejemplo: si la imagen grande fuera "imagen1.jpg", 
        // el thumbnail se llamaría "tn_imagen1.jpg" 
        // Aquí tendremos el nombre de la imagen. 
        $nombre = $id_user.$imagen['name'];
        
        
        $rootPath = getcwd();

        // Aquí la ruta especificada para buscar la imagen. 
        $camino = $rootPath . '\public\img\news\\' ;
        $caminoImagen = $camino . '\\' .$nombre;
        
        
        // Intentamos crear el directorio de thumbnails, si no existiera previamente. 
        if (!file_exists($camino)) {
            mkdir($camino);
        }


        // Aquí comprovamos que la imagen que queremos crear no exista previamente 
        if (!file_exists($caminoImagen)) {
            switch ($imagen['type']) {
                case 'image/png':
                    $img = imagecreatefrompng($imagen['tmp_name']) or die("No se encuentra la imagen $camino$nombre<br>\n");
                    break;
                case 'image/gif':
                    $img = imagecreatefromgif($imagen['tmp_name']) or die("No se encuentra la imagen $camino$nombre<br>\n");
                    break;
                case 'image/jpeg':
                    $img = imagecreatefromjpeg($imagen['tmp_name']) or die("No se encuentra la imagen $camino$nombre<br>\n");
                    break;
                case 'image/bmp':
                    $img = imagecreatefrombmp($imagen['tmp_name']) or die("No se encuentra la imagen $camino$nombre<br>\n");
                    break;
                default:
                    $img = null;
            }




            // miramos el tamaño de la imagen original... 
            $datos = getimagesize($imagen['tmp_name']or die("Problemas con $camino$nombre<br>\n"));

            
            $altura = $amplada*$datos[1]/$datos[0];

            // esta será la nueva imagen reescalada 
            $rezise = imagecreatetruecolor($amplada, $altura);

            // con esta función la reescalamos 
            imagecopyresampled($rezise, $img, 0, 0, 0, 0, $amplada, $altura, $datos[0], $datos[1]);

            // voilà la salvamos con el nombre y en el lugar que nos interesa. 
            imagejpeg($rezise, $caminoImagen);
        }
    }
}
