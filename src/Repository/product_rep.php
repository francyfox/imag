<?php


namespace App\Repository;

use App\Services\products as products;

class product_rep
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $product_name
     */

    private $product_name;

    /**
     * @var int $product_num;
     */

    private $category_name;

    /**
     * @var int $category_name;
     */

    private $product_num;

    /**
     * @var int $product_price;
     */

    private $product_price;

    /**
     * @var array $img_urls;
     */

    private $img_urls = [];


    public function __construct(
        int $id,
        string $product_name,
                                string $category_name,
                                int $product_price,
                                int $product_num){
        $this->id;
        $this->product_name;
        $this->category_name;
        $this->product_price;
        $this->product_num;
    }


    public function getId(){
        $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->category_name;
    }

    /**
     * @return array
     */
    public function getImgUrls(): array
    {
        return $this->img_urls;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->product_name;
    }

    /**
     * @return int
     */
    public function getProductNum(): int
    {
        return $this->product_num;
    }

    /**
     * @return int
     */
    public function getProductPrice(): int
    {
        return $this->product_price;
    }

    /**
     * @param int $category_name
     */
    public function setCategoryName(int $category_name): void
    {
        $this->category_name = $category_name;
    }

    /**
     * @param array $img_urls
     */
    public function setImgUrls(array $img_urls): void
    {
        $this->img_urls = $img_urls;
    }

    /**
     * @param string $product_name
     */
    public function setProductName(string $product_name): void
    {
        $this->product_name = $product_name;
    }

    /**
     * @param int $product_num
     */
    public function setProductNum(int $product_num): void
    {
        $this->product_num = $product_num;
    }

    /**
     * @param int $product_price
     */
    public function setProductPrice(int $product_price): void
    {
        $this->product_price = $product_price;
    }



}
