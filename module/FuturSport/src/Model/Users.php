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
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->rol_id = !empty($data['rol_id']) ? $data['rol_id'] : null;
        $this->username  = !empty($data['username']) ? $data['username'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->surname  = !empty($data['surname']) ? $data['surname'] : null;
        $this->password  = !empty($data['password']) ? $data['password'] : null;
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
        ]);
       
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

}