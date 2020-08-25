<?php


namespace App\Services;

use App\Repository\product_rep as rep;

interface Product {
    public function add_id(int $id) : Product;
    public function add_category(string $category) : Product;
    public function add_cID(int $c_id) : Product;
    public function add_name(string $name) : Product;
    public function add_num(int $num) : Product;
    public function add_price(float $price) : Product;
    public function add_img_urls(array $img_urls) : Product;
    public function AddNewProduct() : Product;
}

class NewProduct implements Product
{
    protected $get;

    protected function reset(): void
    {
        $this->get = new \stdClass();
    }

    public function add_id(int $id): Product
    {
        $this->reset();
        $this->get->id = $id;
        return $this;
    }
    public function add_category(string $category): Product
    {
        $this->get->category = $category;
        return $this;
    }
    public function add_cID(int $c_id): Product
    {
        $this->get->c_id = $c_id;
        return $this;
    }
    public function add_name(string $name): Product
    {
        $this->get->name = $name;
        return $this;
    }
    public function add_num(int $num): Product
    {
        $this->get->num = $num;
        return $this;
    }
    public function add_price(float $price): Product
    {
        $this->get->price = $price;
        return $this;
    }
    public function add_img_urls(array $img_urls): Product
    {
        $this->get->img_urls = $img_urls;
        return $this;
    }
    public function AddNewProduct(): Product
    {
        $get = $this;
        $array = (array)$get->get;

        foreach ($array as $key => $val) {
            if (gettype($val) == 'string'){
                $array[$key] = "'" .$val . "'";
            }
        }
        $string = implode(',', $array);

        return $get;
    }
}