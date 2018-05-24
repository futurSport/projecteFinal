<?php

namespace FuturSport\Form;

use Zend\Form\Form;


class UsersForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('users');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'username',
            'type' => 'text',
            
            'options' => [
                'label' => 'Correu Electrònic: ',
            ],
        ]);
       $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'Contrasenya: ',
            ],
        ]);
       $this->add([
            'name' => 'rol_id',
            'type' => 'select',
            'options' => [
                'label' => 'Rol',
            ],
        ]);
       $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Nom',
            ],
        ]);
       $this->add([
            'name' => 'surname',
            'type' => 'text',
            'options' => [
                'label' => 'Cognom',
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

