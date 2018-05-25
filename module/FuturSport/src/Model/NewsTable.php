<?php
namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;
class NewsTable
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
    public function saveNew($id_user,$body, $img,$url){
        $data = [
            'id_user'  => $id_user,
            'body'=>$body,
            'img'=>$img,
            'url'=>$url,
        ];
        
        if ($this->tableGateway->insert($data)) {
            return true;
        }
        return false;
    }
    public function get10news($idUser){
        $row = $this->tableGateway->select(['id_user'=>$idUser],function (Select $select) {
            $select->order('date DESC');
            $select->limit(10);
        });
        return $row;
    }
}

