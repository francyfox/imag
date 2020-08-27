<?php

namespace App\Controller;

use App\Services\products;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\csv;
use Symfony\Component\Validator\Constraints\Json;

class CsvController extends AbstractController
{

    private $csv2json;

    /**
     * @Route("/csv", name="csv")
     *
     */


    public function index(csv $csv, products $products)
    {
        $request = new Request(
            $_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );

        $isfile = $request->files;

        $csv->GetCsV();

        return $this->render('csv/index.html.twig', [
            'controller_name' => 'CsvController',
        ]);
    }
}
