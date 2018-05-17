<?php

namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Crypt\Password\Bcrypt;

class UsersTable
{
    private $tableGateway;
    private $bcrypt;
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        $bcrypt=new Bcrypt();
        $this->bcrypt=$bcrypt;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getUser($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                _('Could not find row with identifier %d'),
                $id
            ));
        }

        return $row;
    }
    public function getUserRegister($username)
    {
        
        $sql="select u.id, u.password ,r.name as 'rol_name', u.name, u.surname from users u inner join rol r on u.rol_id=r.id where u.username='".$username."'";
        $rowset=$this->tableGateway->getAdapter()->driver->getConnection()->execute($sql); 
 

        $row = $rowset->current();
        if (! $row) {
            return '';
        }

        return $row;
    }

    public function saveUser(Users $user)
    {
        $password=$this->bcrypt->create($user->password);
        $data = [
            'rol_id' => $user->rol_id,
            'username'  => $user->username,
            'name' => $user->name,
            'surname'  => $user->surname,
            'password' =>$password
        ];

        $id = (int) $user->id;

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
        //$rows = $this->tableGateway->select(['name LIKE ?'=>'%'.$clausule.'%']);
        $sql="select u.id, r.name as 'rol_name', u.name, u.surname, u.username from users u inner join rol r on u.rol_id=r.id where u.name LIKE '%".$clausule."%'";
        $rows=$this->tableGateway->getAdapter()->driver->getConnection()->execute($sql); 
        return $rows;
    }
}

