<?php
namespace FuturSport\Form;

use Zend\Form\Form;


class ComarquesForm extends Form
{
     public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('comarques');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            
            'options' => [
                'label' => 'Nom comarca: ',
            ],
        ]);
         $this->add([
            'name' => 'id_provincia',
            'type' => 'select',
            'options' => [
                'label' => 'Província',
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