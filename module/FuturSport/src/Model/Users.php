<?php

namespace FuturSport\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Users{
    public $id;
    public $rol_id;
    public $username;
    public $name;
    public $surname;
    public $password;

    private $inputFilter;
    
    public function __construct($username=null, $password=null, $name=null, $surname=null, $rol_id=null, $id=null) {
        $this->username=$username;
        $this->password=$password;
        $this->name=$name;
        $this->surname=$surname;
        $this->rol_id=$rol_id;
        $this->id=$id;
    }
    
    public function getId(){return $this->id;}
    public function getUsername(){return $this->username;}
    public function getPassword(){return $this->password;}
    public function getName(){return $this->name;}
    public function getSurname(){return $this->surname;}
    public function getRol_id(){return $this->rol_id;}
    
    
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->rol_id = !empty($data['rol_id']) ? $data['rol_id'] : null;
        $this->username  = !empty($data['username']) ? $data['username'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->surname  = !empty($data['surname']) ? $data['surname'] : null;
        $this->password  = !empty($data['password']) ? $data['password'] : null;
    }
    
    public function getArrayCopy()
    {
        return [
            'id'     => $this->id,
            'rol_id' => $this->rol_id,
            'username'  => $this->username,
            'name'  => $this->name,
            'surname'  => $this->surname,
            'password'  => $this->password,
        ];
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();
         $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'username',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'password',
            'required' => true,
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'min' => 8,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'rol_id',
            'required' => true,
        ]);
        $inputFilter->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);
         $inputFilter->add([
            'name' => 'surname',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

}