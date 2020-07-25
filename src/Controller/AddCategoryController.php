<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddCategoryController extends AbstractController
{
    /**
     * @Route("/add/category", name="add_category")
     */
    public function index()
    {
        return $this->render('add_category/index.html.twig', [
            'controller_name' => 'AddCategoryController',
        ]);
    }
}
