<?php


namespace App\Repository;

use App\Services\NewProduct;
use App\Services\products as products;

class product_rep
{

   public function __construct(NewProduct $newProduct
   ){
       $newProduct->add_id();
       $newProduct->add_category();
       $newProduct->add_cID();
       $newProduct->add_name();
       $newProduct->add_num();
       $newProduct->add_price();
       $newProduct->add_img_urls();

       return $newProduct->AddNewProduct();
   }
}
