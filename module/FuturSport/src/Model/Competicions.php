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

class Competicions{
    public $id;
    public $cat_competicio;
    public $name;
   
     private $inputFilter;
    
    public function getId(){return $this->id;}
    public function getCatCompeticio(){return $this->cat_competicio;}
    public function getName(){return $this->name;}
   
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->cat_competicio     = !empty($data['cat_competicio']) ? $data['cat_competicio'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;     
    }
   
     public function getArrayCopy()
    {
        return [
            'id'     => $this->id,
            'cat_competicio'=>$this->cat_competicio,
            'name' => $this->name,
            
            
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
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);
       $inputFilter->add([
            'name' => 'cat_competicio',
            'required' => false,
            
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}