<?php

namespace App\Controller;

use App\Services\products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WatchController extends AbstractController
{
    /**
     * @Route("/watch", name="watch")
     */
    public function index(products $products)
    {
        $obj = [
            new products
        ];

        $id = (int)$_GET['id'];
        $obj[0]->getProductById($id);
        return $this->render('watch/index.html.twig', [
            'obj' => $obj,
            'controller_name' => 'Preview Product'
        ]);
    }
}
