<?php
namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;
class CategoriesTable
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
    public function getCategoria($id){
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
    public function getAllRowsOrd(){
        $row = $this->tableGateway->select(function (Select $select) {
            $select->order('name ASC');});
        return $row;
    }
    public function saveCategoria(Categories $categoria){
        $data = [
            'id' => $categoria->id,
            'name'  => $categoria->name,
        ];

        $id = (int) $categoria->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getCategoria($id)) {
            throw new RuntimeException(sprintf(
                _('Cannot update categoria with identifier %d; does not exist'),
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }
    public function deleteCategoria($id)
    {
        if($this->tableGateway->delete(['id' => (int) $id])){
            return true;
        }
        return false;
    }
}
