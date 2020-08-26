<?php


namespace App\Services;

use App\Services\db as db;
use App\Repository\product_rep as rep;
use App\Services\products as products;

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

        $this->get->id = $id;
        return $this;
    }
    public function add_category(string $category): Product
    {
        $this->reset();
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
        $get = $this
                ->add_id(0)
                ->add_cID(0);

        $array = (array)$get->get;
        $properties = array('id', 'c_id', 'category', 'name', 'num', 'price');

        $array_sort = rep::sortArrayByArray($array, $properties);

        foreach ($array_sort as $key => $val) {
            if (gettype($val) == 'string'){
                $array_sort[$key] = "'" .$val . "'";
            }
        }
        $string = implode(',', $array_sort);


        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        $query ="INSERT INTO products VALUES ($string)";
        var_dump($query);
        $result = mysqli_query($mysqli, $query) or die("Ошибка 1 - " . mysqli_error($mysqli));



//        if ($array_sort['img_urls'] != ""){
//            $name = $array_sort['name'];
//            $query = "SELECT id FROM products where name=$name";
//            $result = mysqli_query($mysqli, $query) or die("Ошибка 2 - " . mysqli_error($mysqli));;
//            $getFotoId = mysqli_fetch_assoc($result);
//
//            $get_urls = $array_sort['img_urls'];
//            $urls = explode('/orig', $_GET['imgurls']);
//            products::getImgUrls($getFotoId["id"], $urls);
//        }


        return $get;
    }
}