<?php
namespace FuturSport\Form;

use Zend\Form\Form;


class CategoriesForm extends Form
{
     public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('provincies');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            
            'options' => [
                'label' => 'Nom província: ',
            ],
        ]);
        $this->add([
            'name' => 'cat_competicio',
            'type' => 'number',
            
            'options' => [
                'label' => 'Nivell de competició: ',
            ],
            'attributes' => [
                'min' => '0',
                'max' => '10',
                
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }    
}