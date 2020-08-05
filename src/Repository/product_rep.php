<?php


namespace App\Repository;


class product_rep
{
    private $product_id;

    /**
     * @return mixed
     */

    public function setProductId($product_id) : int {
        $this->product_id = $product_id;
    }

}
