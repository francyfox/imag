<?php

namespace App\Services;


class products
{
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
            $cat_id = 0;
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
            var_dump($_GET['name']);
            $p_name = mysqli_real_escape_string($mysqli, $_GET['name']);
            $p_category = mysqli_real_escape_string($mysqli, $_GET['category']);
            $p_num = mysqli_real_escape_string($mysqli, $_GET['number']);
            $p_price = mysqli_real_escape_string($mysqli, $_GET['price']);
            $p_id = 0;
            $query ="INSERT INTO products VALUES ($p_id, $p_id, '$p_category', '$p_name', $p_num, $p_price)";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            $p_id++;
            products::reload('main');
        }
    }
}

/*
 * INSERT INTO products (id, category, name, num, price) VALUES ("1", "Стиралка", "SUMSUNG", "12", "70000");
 * INSERT INTO products (id, category, name, num, price) VALUES ("2", "Телевизор", "LG", "7", "120000");
 * INSERT INTO products (id, category, name, num, price) VALUES ("3", "Пылесос", "KARCHER", "7", "80000");
 */