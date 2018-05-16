<?php

namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;


class UsersTable
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

    
    public function getUser(Users $user)
    {
        $sql="select u.id, r.name as 'rol_name', u.name, u.surname from users u inner join rol r on u.rol_id=r.id where u.username='".$user->username."' and u.password='".$user->password."'";
        $rowset=$this->tableGateway->getAdapter()->driver->getConnection()->execute($sql); 
 

        $row = $rowset->current();
        if (! $row) {
            return '';
        }

        return $row;
    }

    public function saveUser(Users $user)
    {
        $data = [
            'id_rol' => $user->id_rol,
            'username'  => $user->username,
            'name' => $user->name,
            'surname'  => $user->surname,
            'password' =>$user->password
        ];

        $id = (int) $album->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getUser($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update user with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteUser($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
    public function getAllRows($clausule=''){
        $rows = $this->tableGateway->select(['name LIKE ?'=>'%'.$clausule.'%']);

        
        return $rows;
    }
}

