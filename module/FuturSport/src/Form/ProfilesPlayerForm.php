<?php

namespace FuturSport\Form;

use Zend\Form\Form;


class ProfilesPlayerForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('ProfilesPlayer');

        $this->add([
            'name' => 'id_user',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'team',
            'type' => 'text',
            'options' => [
                'label' => 'Equip: ',
            ],
        ]);
        $this->add([
            'name' => 'id_categoria',
            'type' => 'select',
            'options' => [
                'label' => 'Categoria:',
            ],
        ]);
       $this->add([
            'name' => 'id_competicio',
            'type' => 'select',
            'options' => [
                'label' => 'Categoria:',
                'disable_inarray_validator' => true,

            ],
        ]);
         $this->add([
            'name' => 'id_position',
            'type' => 'select',
            'options' => [
                'label' =>'Posició:',
            ],
        ]);
       $this->add([
            'name' => 'age',
            'type' => 'number',
            'options' => [
                'label' => 'Edat: ',
            ],
        ]);
       
       $this->add([
            'name' => 'weight',
            'type' => 'number',
            'options' => [
                'label' => 'Pes: ',
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



