<?php


namespace App\Repository;


class product_rep
{
    /**
     * @return mixed
     */
    private $product_id;

    private $state;

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

    public function status($property, $value) : array {
        $state_new = new $this->state;
        $result =  $state_new = [
            $property => $value
        ];
        return $result;
    }

    public function __set($property, $value){
        $this->$property = $value;
        $this->status($property, true);
    }

    public function __get($property){
        return $this->$property;
    }



}
