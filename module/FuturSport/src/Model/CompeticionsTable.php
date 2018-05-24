<?php
namespace FuturSport\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;

class CompeticionsTable
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
    
     public function getCompeticio($id){
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
    public function getCompeticions($cat_competicio){
        $rows = $this->tableGateway->select(['cat_competicio' => $cat_competicio]);
        
        return $rows;
    }
    public function getAllRowsOrd(){
        $row = $this->tableGateway->select(function (Select $select) {
        $select->order('cat_competicio ASC');});
        return $row;
    }
    public function saveCompeticio(Competicions $competicio){
        $data = [
            'id' => $competicio->id,
            'cat_competicio'=>$competicio->cat_competicio,
            'name'  => $competicio->name,
        ];

        $id = (int) $competicio->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getCompeticio($id)) {
            throw new RuntimeException(sprintf(
                _('Cannot update categoria with identifier %d; does not exist'),
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }
    public function deleteCompeticio($id){
        if($this->tableGateway->delete(['id' => (int) $id])){
            return true;
        }
        return false;
    }
}