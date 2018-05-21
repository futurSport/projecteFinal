<?php
namespace FuturSport\Form;

use Zend\Form\Form;


class ProfileForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('users');

        $this->add([
            'name' => 'id_user',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'photo',
            'type' => 'file',
            'options' => [
                'label' => 'Foto de perfil: ',
            ],
        ]);
       $this->add([
            'name' => 'id_provincia',
            'type' => 'select',
            'options' => [
                'label' => 'Provincia: ',
            ],
        ]);
       $this->add([
            'name' => 'id_comarca',
            'type' => 'select',
           
            'options' => [
                'disable_inarray_validator' => true,
                'label' => 'Comarca',
            ],
        ]);
       $this->add([
            'name' => 'poblacio',
            'type' => 'text',
            'options' => [
                'label' => 'Població: ',
            ],
        ]);
       $this->add([
            'name' => 'direccio',
            'type' => 'text',
            'options' => [
                'label' => 'Direcció: ',
            ],
        ]);
       $this->add([
            'name' => 'telefon',
            'type' => 'text',
            'options' => [
                'label' => 'telefon: ',
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

