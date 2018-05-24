<?php
namespace FuturSport\Form;

use Zend\Form\Form;


class CompeticionsForm extends Form
{
     public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('competicions');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            
            'options' => [
                'label' => 'Nom competicio: ',
            ],
        ]);
         $this->add([
            'name' => 'cat_competicio',
            'type' => 'number',
            
            'options' => [
                'label' => 'Categoria competicio: ',
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