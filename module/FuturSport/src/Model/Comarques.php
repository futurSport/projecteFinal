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

class Comarques{
    public $id;
    public $id_provincia;
    public $name;
   
    private $inputFilter;
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
        $this->id_provincia     = !empty($data['id_provincia']) ? $data['id_provincia'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;     
    }
   
     public function getArrayCopy()
    {
        return [
            'id'     => $this->id,
            'id_provincia'=>$this->id_provincia,
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
            'name' => 'id_provincia',
            'required' => true,
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}