<?php

namespace FuturSport\Form;

use Zend\Form\Form;


class PosicionsForm extends Form
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
                'label' => 'Nom posició: ',
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