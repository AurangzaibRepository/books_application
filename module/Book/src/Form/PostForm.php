<?php

namespace Book\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Book\Entity\Author;
use Zend\Validator\NotEmpty;

/**
 * This is used to work with form data
 */
class PostForm extends Form
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct('book-form');
        
        $this->addElements();
        $this->addInputFilters();
    }

    private function addElements()
    {
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'textarea',
            'attributes' => [
                'class' => 'form-control',
                'rows' => 6
            ]
        ]);

        $this->add([
            'name' => 'author_id',
            'type' => 'select',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options' => [
                'empty_option' => '-- Select --',
                'value_options' => $this->getAuthors()
            ]
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'class' => 'btn btn-primary'
            ]
        ]);
    }

    private function addInputFilters()
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name' => 'title',
            'required' => true,
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Title required'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'description',
            'required' => true,
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Decription required'
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'author_id',
            'required' => true
        ]);
    }

    private function getAuthors(): array
    {
        $response = [];

        $data = $this->entityManager
                        ->getRepository(Author::class)
                        ->findBy(
                            [],
                            ['name' => 'asc']
                        );
        
        foreach ($data as $row) {
            $response[$row->getName()] = $row->getName();
        }

        return $response;
    }
}
