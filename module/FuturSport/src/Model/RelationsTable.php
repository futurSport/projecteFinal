<?php

namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;

class RelationsTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    public function fan($user_pichichi, $user_fan){
        $data = [
            'user_fan'  => $user_fan,
            'user_pichichi'=>$user_pichichi
        ];
        if ($this->tableGateway->insert($data)) {
            return true;
        }
        return false;
    }
    public function getRelation($user_fan, $user_pichichi){
        
        $rowset = $this->tableGateway->select(['user_fan' => $user_fan, 'user_pichichi'=>$user_pichichi]);
        $row = $rowset->current();
        if (! $row) {
            return false;
        }

        return true;
    }
    public function deixa($user_pichichi, $user_fan){
        if($this->tableGateway->delete(['user_fan' => $user_fan, 'user_pichichi'=>$user_pichichi])){
            return true;
        }
        return false;
    }
    public function get5Pichichis($user_fan){
        $sql="select user_pichichi, name, surname from relations r inner join users u on r.user_pichichi=u.id where user_fan=".$user_fan." limit 5";
        $rows=$this->tableGateway->getAdapter()->driver->getConnection()->execute($sql); 
        return $rows;
    }
}
