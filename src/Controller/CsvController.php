<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CsvController extends AbstractController
{
    /**
     * @Route("/csv", name="csv")
     */
    public function index()
    {
        return $this->render('csv/index.html.twig', [
            'controller_name' => 'CsvController',
        ]);
    }
}
