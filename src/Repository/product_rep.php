<?php


namespace App\Repository;


class product_rep
{
    private $cat_id = 0;

    /**
     * @param int $cat_id
     */

    public function getCatId(){
        return $this->cat_id;
    }
}