<?php

namespace App\Controller;

use App\Repository\product_rep;
use App\Services\db;
use App\Services\products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class EditProductController extends AbstractController
{
    /**
     * @Route("/edit/product", name="edit_product")
     */
    public function index(products $products, db $db, product_rep $rep)
    {
        $connect = $db->connect();

        $obj = [
            new $rep,
            new $products
        ];

        $id = $obj[0]->product_id;
        $obj[1]->__getProductById($connect, $id);
        $cat_list = $products->cat_list($connect);
        $items_list = $products->items_list($connect);
        return $this->render('edit_product/index.html.twig', [
            'connect' => $connect,
            'obj' => $obj,
            'items_list' => $items_list,
            'controller_name' => 'EditProductController',
            'category_list' => $cat_list
        ]);
    }
}
