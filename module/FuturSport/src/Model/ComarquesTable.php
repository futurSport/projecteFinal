<?php
namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class ComarquesTable
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
    public function getComarques($id_provincia){
        $rows = $this->tableGateway->select(['id_provincia' => $id_provincia]);
        
        return $rows;
    }
    public function getComarca($id){
        $row=$this->tableGateway->select(['id'=>$id]);
        return $row->current();
    }
    public function getAllRowsOrd(){
        $sql="select c.id, c.name, p.name 'pro_name' from comarques c inner join provincies p on c.id_provincia=p.id order by name ASC";
        $rows=$this->tableGateway->getAdapter()->driver->getConnection()->execute($sql); 
        if (! $rows) {
            return '';
        }
        return $rows;
    }
    public function saveComarca(Comarques $comarca){
        $data = [
            'id' => $comarca->id,
            'id_provincia' =>$comarca->id_provincia,
            'name'  => $comarca->name,
            
        ];
        
        $id = (int) $comarca->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getComarca($id)) {
            throw new RuntimeException(sprintf(
                _('Cannot update comarca with identifier %d; does not exist'),
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }
    public function deleteComarca($id)
    {
        if($this->tableGateway->delete(['id' => (int) $id])){
            return true;
        }
        return false;
    }
}