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
}
