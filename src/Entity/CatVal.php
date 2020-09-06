<?php


namespace DocRep;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class CatVal
 * @package App/Entity
 * @ORM\Table(name="category")
 * @ORM\Entity()
 */

class CatVal
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $category_id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }
}