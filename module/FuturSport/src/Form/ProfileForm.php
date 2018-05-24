<?php
namespace FuturSport\Form;

use Zend\Form\Form;

use Zend\Form\Element;
class ProfileForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('profile');

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
                'label' => 'Província: ',
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
            'type' => Element\Tel::class,
            'name' => 'telefon',
            'options' => [
                'label' => 'Telefon',
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

