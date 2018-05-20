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
}