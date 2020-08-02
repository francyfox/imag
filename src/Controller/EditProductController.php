<?php

namespace App\Controller;

use App\Services\db;
use App\Services\products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class EditProductController extends AbstractController
{
    /**
     * @Route("/edit/product", name="edit_product")
     */
    public function index(products $products, db $db)
    {
        $connect = $db->connect();
        $cat_list = $products->cat_list($connect);
        return $this->render('edit_product/index.html.twig', [
            'controller_name' => 'EditProductController',
            'category_list' => $cat_list
        ]);
    }
}
