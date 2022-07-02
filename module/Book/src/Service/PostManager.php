<?php

namespace Book\Service;

use Book\Entity\Book;
use Book\Entity\Author;

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

    public function add(array $data): void
    {
        $book = new Book();
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $book->setAuthorId($data['author_id']);
        $book->setAuthor($this->getAuthor($data['author_id']));

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function update(Book $book, array $data): void
    {
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $book->setAuthorId($data['author_id']);

        $this->entityManager->flush();
    }

    public function getBook(int $Id)
    {
        return $this->entityManager
                ->getRepository(Book::class)
                ->findOneById($Id);
    }

    public function delete(Book $book): void
    {
        $this->entityManager->remove($book);
        $this->entityManager->flush();
    }

    public function transformData(Book $book): array
    {
        return [
            'title' => $book->getTitle(),
            'description' => $book->getDescription(),
            'author_id' => $book->getAuthorId()
        ];
    }

    private function getAuthor(int $id): Author
    {
        return $this->entityManager
                    ->getRepository(Author::class)
                    ->findOneById($id);
    }
}
