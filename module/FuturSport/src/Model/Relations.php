<?php
namespace FuturSport\Model;
class Relations{
    public $id;
    public $user_fan;
    public $user_pichichi;
    
    /* public function __construct($name, $description, $id=null) {
        $this->name=$name;
        $this->description=$description;
        $this->id=$id;
    }*/
    public function getId(){return $this->id;}
    public function getUserFan(){return $this->user_fan;}
    public function getUserPichichi(){return $this->user_pichichi;}
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->user_fan = !empty($data['user_fan']) ? $data['user_fan'] : null;
        $this->user_pichichi  = !empty($data['user_pichichi']) ? $data['user_pichichi'] : null;
        
    }
}


