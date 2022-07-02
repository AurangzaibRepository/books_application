<?php

namespace Book\Service;

use Book\Entity\Book;

class PostManager
{
    /**
     * Entity manager
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add($data)
    {
        $book = new Book();
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $book->setAuthorId($data['author_id']);

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
