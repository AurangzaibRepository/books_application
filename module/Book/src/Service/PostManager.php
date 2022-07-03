<?php

namespace Book\Service;

use Book\Entity\Book;
use Book\Entity\Author;
use Book\Entity\Category;

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
        $book = $this->setEntityData($book, $data);
        $book->setAuthor($this->getAuthor($data['author_id']));
        $this->addCategories($data['category_ids'], $book);

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function update(Book $book, array $data): void
    {
        $book = $this->setEntityData($book, $data);
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

    private function setEntityData(Book $book, $data): Book
    {
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $book->setAuthorId($data['author_id']);

        return $book;
    }

    private function addCategories(array $categoryIds, Book $book): void
    {
        foreach ($categoryIds as $categoryId) {
            $category = $this->entityManager
                                ->getRepository(Category::class)
                                ->findOneById($categoryId);

            $book->addCategory($category);
        }
    }
}
