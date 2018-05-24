<?php
namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class ProfilesPlayerTable{
    private $tableGateway;
   
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        
    }
    public function getPerfilPlayer($id){
            $id = (int) $id;
            $sql="select p.team, cat.name as 'cat_name', pos.name as 'pos_name', p.age, p.weight from player_profile p left join categories cat on cat.id=p.id_categoria left join player_position pos on pos.id=p.id_position where p.id_user=".$id;
            $rowset=$this->tableGateway->getAdapter()->driver->getConnection()->execute($sql); 
 
            
            
            if (! $rowset) {
                return false;
            }

            return $rowset->current();
    }
    public function newProfileUser(ProfilesPlayer $profilePlayer){
        
         $data = [
            'id_user' => $profilePlayer->id_user,
            'team'  => $profilePlayer->team,
            'id_categoria' => $profilePlayer->id_categoria,
            'id_position'  => $profilePlayer->id_position,
            'age' =>$profilePlayer->age,
            'height'=>$profilePlayer->height,
            'weight'=>$profilePlayer->weight
             
        ];
         if($this->tableGateway->insert($data)){
             return true;
         }
         return false;
    }
}
