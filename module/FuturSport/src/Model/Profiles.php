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
use Zend\Validator\Regex;
class Profiles{
    public $id;
    public $photo;
    public $id_provincia;
    public $id_comarca;
    public $poblacio;
    public $direccio;
    public $telefon;
    
    private $inputFilter;
    /* public function __construct($name, $description, $id=null) {
        $this->name=$name;
        $this->description=$description;
        $this->id=$id;
    }*/
    
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->photo = !empty($data['photo']) ? $data['photo'] : null;
        $this->id_provincia  = !empty($data['id_provincia']) ? $data['id_provincia'] : null;
        $this->id_comarca   = !empty($data['id_comarca']) ? $data['id_comarca'] : null;
        $this->poblacio = !empty($data['poblacio']) ? $data['poblacio'] : null;
        $this->direccio  = !empty($data['direccio']) ? $data['direccio'] : null;
        $this->telefon  = !empty($data['telefon']) ? $data['telefon'] : null;
        
    }
    public function getArrayCopy()
    {
        return [
            'id_user'     => $this->id_user,
            'photo' => $this->photo,
            'id_provincia'  => $this->id_provincia,
            'id_comarca'  => $this->id_comarca,
            'poblacio'  => $this->pobacio,
            'direccio'  => $this->direccio,
            'telefon'  => $this->telefon,
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
            'name' => 'photo',
        ]);
        $inputFilter->add([
            'name' => 'id_provincia',
            'required' => true,
        ]);
        $inputFilter->add([
            'name' => 'id_comarca',
            'required' => true,
        ]);
        $inputFilter->add([
            'name' => 'poblacio',
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 200,
                    ],
                ],
            ],
        ]);
         $inputFilter->add([
            'name' => 'direccio',
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 200,
                    ],
                ],
            ],
        ]);
          $inputFilter->add([
            'name' => 'telefon',
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    
                    'name'=> Regex::class,
                    'options'=>[
                        'pattern'=>'[0-9]+'
                    ],
                ],
            ],
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}