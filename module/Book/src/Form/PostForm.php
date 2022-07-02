<?php

namespace Book\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Album\Enity\Album;
use Zend\Validator\NotEmpty;

/**
 * This is used to work with form data
 */
class PostForm extends Form
{
    public function __construct()
    {
        parent::construct('book-form');
        
        $this->addElements();
        $this->addInputFilters();
    }

    private function addElements()
    {
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'attributes' => [
                'id' => 'title'
            ],
            'options' => [
                'label' => 'Title'
            ]
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'textarea',
            'attributes' => [
                'id' => 'description'
            ],
            'options' => [
                'label' => 'Description'
            ]
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Save'
            ]
        ]);
    }
}
