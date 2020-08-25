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

        $imgs = [
            '0' => 'https://avatars.mds.yandex.net/get-mpic/1767083/img_id538587603382211246.jpeg/orig'
        ];
        $products->AddProductNew('test', 'cat_test', 3, 200, $imgs);

        return $this->render('csv/index.html.twig', [
            'controller_name' => 'CsvController',
        ]);
    }
}
