<?php

namespace App\Controller;

use App\Services\NewProduct;
use App\Services\db;
use App\Services\products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(products $products, NewProduct $newProduct)
    {
        $items_list = $products->items_list();
        $cat_list = $products->cat_list();
        $products->delete_category();
        $products->delete_product();
        $products->add_product();
        $products->add_category();
        $products->update_product();

        $add = new $newProduct;
        $add
            ->add_id(1)
            ->add_cID(1)
            ->add_category('TEST')
            ->add_name('TEST')
            ->AddNewProduct();
        var_dump($add);



        return $this->render('main/index.twig', [
            'env_name' => getenv("USER"),
            'controller_name' => 'MainController',
            'items_list' => $items_list,
            'category_list' => $cat_list
        ]);
    }
}