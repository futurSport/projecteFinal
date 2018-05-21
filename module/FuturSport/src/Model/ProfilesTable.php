<?php

namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class ProfilesTable{
    private $tableGateway;
   
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        
    }
    public function getPerfilUser($id){
            $id = (int) $id;
            $rowset = $this->tableGateway->select(['id_user' => $id]);
            $row = $rowset->current();
            if (! $row) {
                return false;
            }

            return $row;
    }
    public function saveProfile(Profiles $profile){
        
         $data = [
            'id_user' => $profile->id_user,
            'photo'  => $profile->photo,
            'id_provincia' => $profile->id_provincia,
            'id_comarca'  => $profile->id_comarca,
            'poblacio' =>$profile->poblacio,
            'direccio'=>$profile->direccio,
            'telefon'=>$profile->telefon
             
        ];
         if($this->tableGateway->insert($data)){
             return true;
         }
         return false;
    }
}