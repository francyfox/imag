<?php

namespace App\Controller;

use App\Services\db;
use App\Services\products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddProductController extends AbstractController
{
    /**
     * @Route("/add/product", name="add_product")
     */
    public function index(products $products, db $db)
    {
        $connect = $db->connect();
        $cat_list = $products->cat_list($connect);
        return $this->render('add_product/index.html.twig', [
            'controller_name' => 'AddProductController',
            'category_list' => $cat_list
        ]);
    }
}
