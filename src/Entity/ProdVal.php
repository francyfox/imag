<?php


namespace DocRep;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * Class ProdVal
 * @package App/Entity
 * @ORM\Table(name="products")
 */

class ProdVal
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */

    private $category_id;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $category;
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $num;
    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * @return mixed
     */
    public function getCategory() : string
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getCid(): int
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @param int $category_id
     */
    public function setCid(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @param int $num
     */
    public function setNum(int $num): void
    {
        $this->num = $num;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}