<?php
namespace FuturSport\Model;
class Comarques{
    public $id;
    public $id_provincia;
    public $name;
   
    
    /* public function __construct($name, $description, $id=null) {
        $this->name=$name;
        $this->description=$description;
        $this->id=$id;
    }*/
    public function getId(){return $this->id;}
    public function getIdProvincia(){return $this->id_provincia;}
    public function getName(){return $this->name;}
   
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->id_provincia     = !empty($data['id_provincia']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;     
    }
}