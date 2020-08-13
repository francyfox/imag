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
    public function index(products $products)
    {
        $obj = [
            new products
        ];

        $id = (int)$_GET['edit'];
        $obj[0]->getProductById($id);
        $cat_list = $products->cat_list();
        $items_list = $products->items_list();
        return $this->render('edit_product/index.html.twig', [
            'obj' => $obj,
            'items_list' => $items_list,
            'category_list' => $cat_list,
            'controller_name' => 'EditProductController'
        ]);
    }
}
