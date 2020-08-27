<?php


namespace App\Services;

use App\Services\db as db;
use App\Repository\product_rep as rep;
use App\Services\products as products;

interface Product {
    public function add_id(int $id) : Product;
    public function add_category(string $category) : Product;
    public function add_cID(int $c_id) : Product;
    public function findSet_cID() : Product;
    public function add_name(string $name) : Product;
    public function add_num(int $num) : Product;
    public function add_price(float $price) : Product;
    public function add_img_urls(string $img_urls) : Product;
    public function update(string $url) : Product;
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
    public function findSet_cID(): Product
    {
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        $category = $this->get->category;
        $query = "SELECT category_id FROM category where category= '$category'";
        $result = mysqli_query($mysqli, $query);
        $fetch = mysqli_fetch_assoc($result);

        if ($fetch != false){
            $get_cID = (int)$fetch["category_id"];
            $this->add_cID($get_cID);
        }else{

            $query ="INSERT INTO category VALUES (0, '$category')";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));

            $query = "SELECT category_id FROM category where category= '$category'";
            $result = mysqli_query($mysqli, $query) or die("Не могу узнать ID категории " . mysqli_error($mysqli) . var_dump($query));

            $get_cID = mysqli_fetch_assoc($result);
            $this->add_cID((int)$get_cID["category_id"]);
        }

        return $this;
    }
    public function add_name(string $name): Product
    {
        $this->reset();
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
    public function add_img_urls(string $img_urls): Product
    {
        $this->get->img_urls = $img_urls;
        return $this;
    }

    public function update(string $url): Product{
        products::reload($url);
        return $this;
    }

    public function AddNewProduct(): Product
    {
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        $get = $this
                ->add_id(0);

        $array = (array)$get->get;
        $properties = array('id', 'c_id', 'category', 'name', 'num', 'price');

        $array_sort = rep::sortArrayByArray($array, $properties);

        foreach ($array_sort as $key => $val) {
            if (gettype($val) == 'string'){
                $array_sort[$key] = "'" .$val . "'";
            }
        }
        $get_urls = $array_sort['img_urls'];

        unset($array_sort['img_urls']);

        $string = implode(',', $array_sort);

        $query ="INSERT INTO products VALUES ($string)";
        $result = mysqli_query($mysqli, $query) or die("Не могу добавить продукт - " . mysqli_error($mysqli) . var_dump($query));

        $name = $array_sort['name'];
        $query = "SELECT id FROM products where name=$name";
        $result = mysqli_query($mysqli, $query) or die("Не могу получить ID - " . mysqli_error($mysqli)). var_dump($query);
        $getFotoId = mysqli_fetch_assoc($result);

        $urls = explode('/orig', $get_urls);
        $p_id =(int)$getFotoId["id"];

        $products = new products();
        $products->getImgUrls($p_id, $urls);

        return $get;
    }
}