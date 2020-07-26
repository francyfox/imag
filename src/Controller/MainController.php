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
        $items_list = $products->items_list($db->connect());
        return $this->render('main/index.twig', [
            'controller_name' => 'MainController',
            'items_list' => $items_list
        ]);
    }
}