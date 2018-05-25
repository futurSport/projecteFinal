<?php

namespace FuturSport\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use FuturSport\Form\ProfileForm;
use FuturSport\Form\ProfilesPlayerForm;
use FuturSport\Model\ProfilesTable;
use FuturSport\Model\UsersTable;
use FuturSport\Model\Profiles;
use FuturSport\Model\ProfilesPlayer;
use FuturSport\Model\ProvinciesTable;
use FuturSport\Model\ComarquesTable;
use FuturSport\Model\ProfilesPlayerTable;
use FuturSport\Model\CategoriesTable;
use FuturSport\Model\PlayerPositionTable;
use FuturSport\Model\CompeticionsTable;
use FuturSport\Model\RelationsTable;
use FuturSport\Model\NewsTable;

class ProfileController extends AbstractActionController {

    private $profileTable;
    private $profilePlayerTable;
    private $provinciesTable;
    private $comarquesTable;
    private $usersTable;
    private $categoriesTable;
    private $playerPositionTable;
    private $competicioTable;
    private $relationsTable;
    private $newsTable;

    public function __construct(ProfilesTable $profileTable, ProfilesPlayerTable $profilePlayerTable, ProvinciesTable $provinciesTable, ComarquesTable $comarquesTable, UsersTable $usersTable, CategoriesTable $categoriesTable, PlayerPositionTable $playerPositionTable, CompeticionsTable $competicioTable, RelationsTable $relationsTable, NewsTable $newsTable) {
        $this->profileTable = $profileTable;
        $this->provinciesTable = $provinciesTable;
        $this->profilePlayerTable = $profilePlayerTable;
        $this->comarquesTable = $comarquesTable;
        $this->usersTable = $usersTable;
        $this->categoriesTable = $categoriesTable;
        $this->playerPositionTable = $playerPositionTable;
        $this->competicioTable = $competicioTable;
        $this->relationsTable=$relationsTable;
        $this->newsTable=$newsTable;
    }

    public function firstProfileAction() {
        $idUser = (int) $this->params()->fromRoute('id', 0);
        if ($this->access()->logat()) {

            if ($idUser == $this->access()->idUser()) {
                if ($this->profileTable->getPerfilUser($idUser) == false) {
                    $form = new ProfileForm();
                    $form->get('submit')->setValue('Actualitzar Perfil');
                    $form->get('id_user')->setValue($idUser);
                    $provincies = $this->getProvinciesforSelect();
                    $form->get('id_provincia')->setValueOptions($provincies);
                    $comarca[''] = "-Selccioni una comarca-";
                    $form->get('id_comarca')->setValueOptions($comarca);
                    $request = $this->getRequest();
                    if (!$request->isPost()) {
                        return ['form' => $form,
                            'id_user' => $idUser];
                    }
                    $post = array_merge_recursive(
                            $request->getPost()->toArray(), $request->getFiles()->toArray()
                    );
                    $profileUser = new Profiles();
                    $form->setInputFilter($profileUser->getInputFilter());
                    $form->setData($post);

                    if (!$form->isValid()) {
                        return ['form' => $form,
                            'id_user' => $idUser];
                    }
                    $data = $form->getData();
                    $data = $this->tractarArrayFirstProfile($data);
                    $profileUser->exchangeArray($data);
                    $this->profileTable->saveProfile($profileUser);
                }
                $this->redirect()->toRoute('camp');
            } else {
                $this->redirect()->toRoute('profile', array(
                    'controller' => 'profile',
                    'action' => 'profile',
                    'id' => $idUser));
            }
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }

    public function profileAction() {
        $idUser = (int) $this->params()->fromRoute('id', 0);
        if ($this->access()->logat() != 0) {
            $profile = $this->profileTable->getPerfilUserCompleted($idUser);
            if ($idUser == $this->access()->idUser()) {
                if ($profile == false) {
                    $this->redirect()->toRoute('profile', array(
                        'controller' => 'profile',
                        'action' => 'first-profile',
                        'id' => $idUser));
                }
            }
            $user = $this->usersTable->getUserPerfil($idUser);
            $profilePlayer = $this->profilePlayerTable->getPerfilPlayer($idUser);
            $relation=$this->relationsTable->getRelation($this->access()->idUser(), $user);
            $seguidors=$this->relationsTable->get5Pichichis($idUser);
            $news=$this->newsTable->get10news($idUser);
            return ['user' => $user,
                'profile' => $profile,
                'profilePlayer' => $profilePlayer,
                'relation'=>$relation,
                'seguidors'=>$seguidors,
                'news'=>$news];
        } else {
            $this->redirect()->toRoute('index');
        }
    }

    public function changeProfileAction() {
        $idUser = (int) $this->params()->fromRoute('id', 0);
        $profile = $this->profileTable->getPerfilUser($idUser);
        if ($this->access()->logat() != 0 && $idUser == $this->access()->idUser()) {
            if ($profile == false) {
                $this->redirect()->toRoute('profile', array(
                    'controller' => 'profile',
                    'action' => 'first-profile',
                    'id' => $idUser));
            }

            $form = new ProfileForm();
            $form->bind($profile);
            $form->get('submit')->setValue('Actualitzar Perfil');
            $form->get('id_user')->setValue($idUser);
            $provincies = $this->getProvinciesforSelect();
            $form->get('id_provincia')->setValueOptions($provincies);
            $comarcaSel = $this->comarquesTable->getComarca($profile->id_comarca);
            $comarca[$profile->id_comarca] = utf8_encode($comarcaSel->name);
            $form->get('id_comarca')->setValueOptions($comarca);
            $request = $this->getRequest();

            if (!$request->isPost()) {
                return ['form' => $form,
                    'id_user' => $idUser,
                    'photo' => $profile->photo];
            }
            $post = array_merge_recursive(
                    $request->getPost()->toArray(), $request->getFiles()->toArray()
            );
            $profileUser = new Profiles();
            $form->setInputFilter($profileUser->getInputFilter());
            $form->setData($post);

            if (!$form->isValid()) {
                return ['form' => $form,
                    'id_user' => $idUser,
                    'photo' => $profile->photo];
            }
            $data = $form->getData();

            $data = $this->tractarArrayUpdateProfile($data, $profile->photo);

            $profileUser->exchangeArray((array) $data);
            $this->profileTable->updateProfile($profileUser);
            $this->redirect()->toRoute('profile', array(
                'controller' => 'profile',
                'action' => 'profile',
                'id' => $idUser));
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }

    public function moreInfoAction() {
        $idUser = (int) $this->params()->fromRoute('id', 0);
        if ($this->access()->logat() != 0 && $idUser == $this->access()->idUser() && $this->access()->rol() == 'jugador') {
            $form = new ProfilesPlayerForm();

            $form->get('id_user')->setValue($idUser);
            $categories = $this->getForSelectCategories();
            $form->get('id_categoria')->setValueOptions($categories);
            $positions = $this->getForSelectPosition();
            $form->get('id_position')->setValueOptions($positions);
            $competicio[''] = "-Selccioni primer una categoria-";
            $form->get('id_competicio')->setValueOptions($competicio);


            $request = $this->getRequest();
            $profilePlayer = $this->profilePlayerTable->getPerfil($idUser);
            if ($profilePlayer == false) {
                $form->get('submit')->setValue('Afegir Informació');
                $profilePlayer = new ProfilesPlayer();
            } else {
                $form->bind($profilePlayer);
                $form->get('submit')->setAttribute('value', 'Modificar Informació');
            }
            if (!$request->isPost()) {
                return ['form' => $form,
                    'id_user' => $idUser];
            }


            $form->setInputFilter($profilePlayer->getInputFilter());
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return ['form' => $form,
                    'id_user' => $idUser];
            }
            $profilePlayer->exchangeArray((array)$form->getData());
            $this->profilePlayerTable->newProfileUser($profilePlayer);
            $this->redirect()->toRoute('profile', array(
                'controller' => 'profile',
                'action' => 'profile',
                'id' => $idUser));
        } else {
            $this->access()->destroySession();
            $this->redirect()->toRoute('index');
        }
    }

    public function getProvinciesforSelect() {
        $provincies = $this->provinciesTable->getAllRowsOrd();
        $provin[''] = '-Seleccioni una provinica-';
        foreach ($provincies as $provincia) {

            $key = $provincia->id;
            $provin[$key] = $provincia->name;
        }
        return $provin;
    }

    public function getForSelectCategories() {
        $categories = $this->categoriesTable->fetchAll();
        $cat[''] = '-Seleccioni una categoria-';
        foreach ($categories as $categoria) {

            $key = $categoria->id;
            $cat[$key] = utf8_encode($categoria->name);
        }
        return $cat;
    }

    public function getForSelectPosition() {
        $positions = $this->playerPositionTable->fetchAll();
        $pos[''] = '-La posició en la qual jugues-';
        foreach ($positions as $position) {

            $key = $position->id;
            $pos[$key] = $position->name;
        }
        return $pos;
    }

    public function selectComarquesAction() {
        $view = new ViewModel();
        $view->setTerminal(true);

        $id_provincia = (int) $this->params()->fromRoute('id', 0);
        if ($id_provincia == 0) {
            echo "0";
        } else {
            $comarques = $this->comarquesTable->getComarques($id_provincia);
            if ($comarques == '') {
                echo 0;
            } else {
                $jsonComar = [];

                array_push($jsonComar, array("", "-Seleccioni una comarca-"));
                foreach ($comarques as $comarca) {

                    array_push($jsonComar, array($comarca->id, utf8_encode($comarca->name)));
                }

                echo json_encode($jsonComar);
            }
        }
        return $view;
    }

    public function selectCompeticioAction() {
        $view = new ViewModel();
        $view->setTerminal(true);

        $id_categoria = (int) $this->params()->fromRoute('id', 0);
        if ($id_categoria == 0) {
            echo "0";
        } else {
            $categoria = $this->categoriesTable->getCategoria($id_categoria);
            $jsonCompeticio = [];
            if ($categoria->cat_competicio == null) {
                array_push($jsonCompeticio, array("", "-Sense competicions-"));
            } else {
                $competicions = $this->competicioTable->getCompeticions($categoria->cat_competicio);

                foreach ($competicions as $competicio) {

                    array_push($jsonCompeticio, array($competicio->id, utf8_encode($competicio->name)));
                }
            }
            echo json_encode($jsonCompeticio);
        }
        return $view;
    }

    public function tractarArrayFirstProfile($data) {

        if (!empty($data['photo']['name'])) {

            $this->thumbjpeg($data['photo'], 230, $data['id_user']);
            $data['photo'] = '/img/' . $data['id_user'] . '/' . $data['photo']['name'];
        } else {
            $data['photo'] = '/img/perfilAnonim.jpg';
        }

        return $data;
    }

    public function tractarArrayUpdateProfile($data, $photo) {
        $photo = $data->photo;
        if (!empty($photo['name'])) {

            $this->thumbjpeg($photo, 230, $data->id_user);
            $data->photo = '/img/' . $data->id_user . '/' . $photo['name'];
        } else {
            $data->photo = $photo;
        }

        return $data;
    }

    function thumbjpeg($imagen, $altura, $id_user) {
        // Lugar donde se guardarán los thumbnails respecto a la carpeta donde está la imagen "grande". 
        // Prefijo que se añadirá al nombre del thumbnail. Ejemplo: si la imagen grande fuera "imagen1.jpg", 
        // el thumbnail se llamaría "tn_imagen1.jpg" 
        // Aquí tendremos el nombre de la imagen. 
        $nombre = $imagen['name'];
        $rootPath = getcwd();

        // Aquí la ruta especificada para buscar la imagen. 
        $camino = $rootPath . '\public\img\\' . $id_user;
        $caminoImagen = $camino . '\\' . $nombre;
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
