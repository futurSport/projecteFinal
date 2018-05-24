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
    public function updateProfile(Profiles $profile){
        
         $data = [
            
            'photo'  => $profile->photo,
            'id_provincia' => $profile->id_provincia,
            'id_comarca'  => $profile->id_comarca,
            'poblacio' =>$profile->poblacio,
            'direccio'=>$profile->direccio,
            'telefon'=>$profile->telefon
             
        ];
         if($this->tableGateway->update($data, ['id_user'=>$profile->id_user])){
             return true;
         }
         return false;
    }
     public function getPerfilUserCompleted($id){
        $sql="select p.id_user, p.photo ,prov.name as 'pro_name', c.name as 'com_name', p.poblacio, p.direccio, p.telefon from profiles p inner join provincies prov on p.id_provincia=prov.id inner join comarques c on p.id_comarca=c.id where p.id_user=".$id;
        $rowset=$this->tableGateway->getAdapter()->driver->getConnection()->execute($sql); 
       if (! $rowset) {
                return false;
            }

            return $rowset->current();
 
     }
}