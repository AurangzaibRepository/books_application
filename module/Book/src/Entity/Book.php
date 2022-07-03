<?php

namespace Book\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents books table
 * @ORM\Entity
 * @ORM\Table(name="books")
 */
class Book
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="title")
     */
    protected $title;

    /**
     * @ORM\Column(name="description")
     */
    protected $description;

    /**
     * @ORM\Column(name="author_id")
     */
    protected $authorId;

    /**
     * @ORM\ManyToOne(targetEntity="\Book\Entity\Author", inversedBy="books")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
   * @ORM\ManyToMany(targetEntity="\Book\Entity\Category", inversedBy="books")
   * @ORM\JoinTable(name="book_categories",
   *      joinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
   *      )
   */
    protected $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getCategories(): string
    {
        $categoryString = '';

        foreach ($this->categories as $category) {
            $categoryString .= "{$category->getName()}, ";
        }
        return rtrim($categoryString, ', ');
    }

    public function getCategoryIds(): array
    {
        $idList = [];

        foreach ($this->categories as $category) {
            $idList[] = $category->getId();
        }
        return $idList;
    }

    public function addCategory($category): void
    {
        $this->categories[] = $category;
    }

    public function removeCategory($category): void
    {
        $this->categories->removeElement($category);
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }
}
