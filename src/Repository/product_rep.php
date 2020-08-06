<?php


namespace App\Repository;


class product_rep
{
    private $product_id;

    /**
     * @return mixed
     */

    public function __set($property, $value){
        $this->$property = $value;
    }

    public function __get($property){
        return $this->$property;
    }

}
