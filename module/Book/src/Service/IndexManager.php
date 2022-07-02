<?php

namespace Book\Service;

use Book\Entity\Book;

class IndexManager
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
