<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddProductController extends AbstractController
{
    /**
     * @Route("/add/product", name="add_product")
     */
    public function index()
    {
        return $this->render('add_product/index.html.twig', [
            'controller_name' => 'AddProductController',
        ]);
    }
}
