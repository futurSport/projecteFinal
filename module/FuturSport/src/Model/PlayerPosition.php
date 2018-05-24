<?php

namespace FuturSport\Model;
class PlayerPosition{
    public $id;
    public $name;
    public $description;
    
    /* public function __construct($name, $description, $id=null) {
        $this->name=$name;
        $this->description=$description;
        $this->id=$id;
    }*/
    public function getId(){return $this->id;}
    public function getName(){return $this->name;}
    public function getDescription(){return $this->description;}
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->description  = !empty($data['description']) ? $data['description'] : null;
        
    }
}

