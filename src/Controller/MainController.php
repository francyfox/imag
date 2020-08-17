<?php

namespace App\Controller;

use App\Services\db;
use App\Services\products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(products $products, db $db)
    {
        $connect = $db->connect();
        $items_list = $products->items_list();
        $cat_list = $products->cat_list();
        $products->delete_category();
        $products->delete_product();
        $products->add_product();
        $products->add_category();
        $products->update_product();
        return $this->render('main/index.twig', [
            'env_name' => getenv("USER"),
            'controller_name' => 'MainController',
            'items_list' => $items_list,
            'category_list' => $cat_list
        ]);
    }
}