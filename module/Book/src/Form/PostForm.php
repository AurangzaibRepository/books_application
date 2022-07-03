<?php

namespace Book\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Book\Entity\Author;
use Book\Entity\Category;
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

    private function addElements(): void
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
            'name' => 'category_ids',
            'type' => 'select',
            'attributes' => [
                'class' => 'form-control',
                'multiple' => 'multiple'
            ],
            'options' => [
                'value_options' => $this->getCategories()
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

    private function addInputFilters(): void
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

        $inputFilter->add([
            'name' => 'category_ids',
            'required' => true
        ]);
    }

    private function getAuthors(): array
    {
        $data = $this->entityManager
                        ->getRepository(Author::class)
                        ->findBy(
                            [],
                            ['name' => 'asc']
                        );
        
        return $this->transformArray($data);
    }

    private function getCategories(): array
    {
        $data = $this->entityManager
                        ->getRepository(Category::class)
                        ->findBy(
                            [],
                            ['name' => 'asc']
                        );

        return $this->transformArray($data);
    }

    private function transformArray($data): array
    {
        $response = [];

        foreach ($data as $row) {
            $response[$row->getId()] = $row->getName();
        }

        return $response;
    }
}
