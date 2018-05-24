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


class ProfilesPlayer{
    public $id_user;
    public $team;
    public $id_categoria;
    public $id_position;
    public $age;
    public $weight;

    private $inputFilter;

    
    public function getId_user(){return $this->id_user;}
    public function getTeam(){return $this->team;}
    public function getId_categoria(){return $this->id_categoria;}
    public function getId_position(){return $this->id_position;}
    public function getAge(){return $this->age;}
    public function getWeight(){return $this->weight;}
    
     public function exchangeArray(array $data)
    {
        $this->id_user     = !empty($data['id_user']) ? $data['id_user'] : null;
        $this->team = !empty($data['team']) ? $data['team'] : null;
        $this->id_categoria  = !empty($data['id_categoria']) ? $data['id_categoria'] : null;
        $this->id_position = !empty($data['id_position']) ? $data['id_position'] : null;
        $this->age  = !empty($data['age']) ? $data['age'] : null;
        $this->weight  = !empty($data['weight']) ? $data['weight'] : null;
    }
    
     public function getArrayCopy()
    {
        return [
            'id_user'     => $this->id_user,
            'team' => $this->team,
            'id_categoria'  => $this->id_categoria,
            'id_position'  => $this->id_position,
            'age'  => $this->age,
             'weight'  => $this->weight,
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
            'name' => 'id_user',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'team',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 100,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'id_categoria',
            'required' => false,
        ]);
        $inputFilter->add([
            'name' => 'id_position',
            'required' => false,
        ]);
         $inputFilter->add([
            'name' => 'age',
            'required' => false,
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' =>2,
                    ],
                ],
            ],
        ]);
      
       $inputFilter->add([
            'name' => 'weight',
            'required' => false,
            'validators' => [
                [
                   'name' => StringLength::class,
                    'options' => [
                        'max' =>5,
                    ],
                    
                ],
            ],
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

}