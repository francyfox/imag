<?php


namespace App\Services;


use Symfony\Component\BrowserKit\Request;
use App\Services\db;
use App\Services\products;

class csv
{
    public function GetCsV(){

        $db = new db;
        $products = new products;


        if($_FILES["file"]["size"] > 0){
            $filename=$_FILES["file"]["tmp_name"];
            $file = fopen($filename, "r");
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
                var_dump($getData[0]);
            }

            fclose($file);
        }

    }
}