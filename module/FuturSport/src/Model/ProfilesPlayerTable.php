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
    public function getPerfil($id){
        $row=$this->tableGateway->select(['id_user'=>$id]);
        if(! $row){
            return false;
        }
        return $row->current();
    }
    public function getPerfilPlayer($id){
            $id = (int) $id;
            $sql="select p.team, cat.name as 'cat_name', com.name as 'com_name',pos.name as 'pos_name', p.age, p.weight from player_profile p"
                    . " left join categories cat on cat.id=p.id_categoria"
                    . " left join player_position pos on pos.id=p.id_position"
                    . " left join competicio com on com.id=p.id_competicio"
                    . " where p.id_user=".$id;
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
            'id_competicio' => $profilePlayer->id_competicio,
            'id_position'  => $profilePlayer->id_position,
            'age' =>$profilePlayer->age,
            'weight'=>$profilePlayer->weight
             
        ];
         $id = (int) $profilePlayer->id_user;


        if ($this->getPerfil($id)==false) {
            $this->tableGateway->insert($data);
            return;
        }

        $this->tableGateway->update($data, ['id_user' => $id]);
    }
}
