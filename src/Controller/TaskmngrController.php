<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TaskmngrController extends AbstractController
{
    /**
     * @Route("/taskmngr", name="taskmngr")
     */
    public function index()
    {
        return $this->render('taskmngr/index.html.twig', [
            'controller_name' => 'TaskmngrController',
        ]);
    }
}
