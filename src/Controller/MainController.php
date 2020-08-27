<?php

namespace App\Controller;

use App\Services\NewProduct;
use App\Services\db;
use App\Services\products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(products $products, NewProduct $newProduct)
    {
        $request = new Request(
            $_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );

        $items_list = $products->items_list();
        $cat_list = $products->cat_list();
        $products->delete_category();
        $products->delete_product();
//        $products->add_product();
        $products->add_category();
        $products->update_product();

        $get_add = $request->get('add');

        if(isset($get_add)){
            $name = $request->get('name');
            $category = $request->get('category');
            $c_id = $request->get('category_id');
            $num = $request->get('number');
            $price = $request->get('price');
            $img_urls = $request->get('imgurls');

            $add = new $newProduct;
            $add
                ->add_name($name)
                ->add_category($category)
                ->add_cID($c_id)
                ->add_price($price)
                ->add_num($num)
                ->add_img_urls($img_urls)
                ->AddNewProduct()
                ->update('main');

        }




        return $this->render('main/index.twig', [
            'env_name' => getenv("USER"),
            'controller_name' => 'MainController',
            'items_list' => $items_list,
            'category_list' => $cat_list
        ]);
    }
}