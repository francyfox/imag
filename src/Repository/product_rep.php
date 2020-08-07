<?php


namespace App\Repository;


class product_rep
{
    /**
     * @return mixed
     */
    private $product_id;

//    /**
//     * @var string $product_name
//     */
//
//    private $product_name;
//
//    /**
//     * @var int $product_num;
//     */
//
//    private $product_num;
//
//    /**
//     * @var int $product_num;
//     */
//
//    private $product_price;
//
//    /**
//     * @var float $product_price;
//     */


    public function __set($property, $value){
        $this->$property = $value;
    }

    public function __get($property){
        return $this->$property;
    }

}
