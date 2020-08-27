<?php


namespace App\Services;


use Symfony\Component\BrowserKit\Request;
use App\Services\db as db;
use App\Services\products;
use App\Services\NewProduct;
use Symfony\Component\Config\Definition\Exception\Exception;

class csv
{
    public function GetCsV(){

        $instance = db::getInstance();
        $mysqli = $instance->getConnection();
        $products = new products;

        if($_FILES){

            $filename=$_FILES["file"]["tmp_name"];
            $file = fopen($filename, "r");
            $add = new newProduct;
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
                $add
                    ->add_name(addslashes($getData[1]))
                    ->add_category(addslashes($getData[0]))
                    ->findSet_cID()
                    ->add_price($getData[3])
                    ->add_num($getData[2])
                    ->add_img_urls($getData[4])
                    ->AddNewProduct();
            }
            fclose($file);
        }

    }
}