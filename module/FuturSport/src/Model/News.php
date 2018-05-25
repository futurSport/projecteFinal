<?php

namespace FuturSport\Model;
class News{
    public $id;
    public $id_user;
    public $body;
    public $img;
    public $url;
    public $date;
    
    /* public function __construct($name, $description, $id=null) {
        $this->name=$name;
        $this->description=$description;
        $this->id=$id;
    }*/
    public function getId(){return $this->id;}
    public function getIdUSer(){return $this->id_user;}
    public function getBody(){return $this->body;}
    public function getImg(){return $this->img;}
    public function getUrl(){return $this->url;}
    public function getDate(){return $this->date;}
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->id_user = !empty($data['id_user']) ? $data['id_user'] : null;
        $this->body  = !empty($data['body']) ? $data['body'] : null;
        $this->img = !empty($data['img']) ? $data['img'] : null;
        $this->url  = !empty($data['url']) ? $data['url'] : null;
        $this->date  = !empty($data['date']) ? $data['date'] : null;
        
    }
}