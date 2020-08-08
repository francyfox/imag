<?php

namespace App\Services;

use App\Repository\product_rep;
use App\Repository\product_rep as rep;

class products
{

    private $GetProdById = [];

    public function reload(string $url){
        header( "Location: http://127.0.0.1:8000/$url" );
        die;
    }

    public function items_list($mysqli){
        $query = "SELECT * FROM products";
        $result = mysqli_query($mysqli, $query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        return $products;
    }

    public function cat_list($mysqli){
        $query = "SELECT * FROM category";
        $result = mysqli_query($mysqli, $query);

        $category = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $category[] = $row;
        }

        return $category;
    }

    public function delete($mysqli){

        if(isset($_GET['id']))
        {
            $id = mysqli_real_escape_string($mysqli, $_GET['id']);
            $query ="DELETE FROM products WHERE id = '$id'";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            products::reload('main');
        }
    }

    public function add_category($mysqli){
        if(isset($_GET['add_cat']))
        {
            $product_rep = new product_rep;
            $cat_id = $product_rep->getCatId();  // TODO:GET CATEGORY
            $cat_name = mysqli_real_escape_string($mysqli, $_GET['cat_name']);
            $query ="INSERT INTO category VALUES ($cat_id, '$cat_name')";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            $cat_id++;
            products::reload('main');
        }
    }

    public function add_product($mysqli){
        if(isset($_GET['add']))
        {
            $product_rep = new product_rep;
            $c_id = mysqli_real_escape_string($mysqli, $_GET['category_id']);
            $p_name = mysqli_real_escape_string($mysqli, $_GET['name']);
            $p_category = mysqli_real_escape_string($mysqli, $_GET['category']);
            $p_num = mysqli_real_escape_string($mysqli, $_GET['number']);
            $p_price = mysqli_real_escape_string($mysqli, $_GET['price']);
            $p_id = 0;
            $query ="INSERT INTO products VALUES ($p_id, $c_id, '$p_category', '$p_name', $p_num, $p_price)";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            $p_id++;
            products::reload('main');
        }
    }

    public function __getProductById($mysqli, $product_id) : array {

        $query = "SELECT * FROM products where id= '$product_id'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());

        if(!$result) {
            die('MySQL Error: ' . mysqli_error());
        }

        else {
            $product = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $this->GetProdById = $row;
            }
            return $product;
        }

        $rep = rep;
        $rep->status('product_id', false);

    }
}
