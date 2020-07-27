<?php

namespace App\Services;


class products
{
    public function reload(){
        header( "Location: http://127.0.0.1:8000/main" );
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

    public function delete($mysqli){

        if(isset($_GET['id']))
        {
            $id = mysqli_real_escape_string($mysqli, $_GET['id']);
            $query ="DELETE FROM products WHERE id = '$id'";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            products::reload();
        }
    }
}

/*
 * INSERT INTO products (id, category, name, num, price) VALUES ("1", "Стиралка", "SUMSUNG", "12", "70000");
 * INSERT INTO products (id, category, name, num, price) VALUES ("2", "Телевизор", "LG", "7", "120000");
 * INSERT INTO products (id, category, name, num, price) VALUES ("3", "Пылесос", "KARCHER", "7", "80000");
 */