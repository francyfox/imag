<?php

namespace App\Controller;

use App\Services\Helper;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\csv;
use App\Services\TaskMngr;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Json;
use DocRep;

class CsvController extends AbstractController
{
    /**
     * @Route("/csv", name="csv")
     *
     */

    public function index(csv $csv, TaskMngr $task)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new DocRep\task();
        $date = date("Y-m-d H:i:s");



        if(isset($_FILES))
        {
            foreach($csv->movecsv() as $key => $item) {

                $task->setId(0);
                $task->setName($key);
                $task->setParams($item);
                $task->setDateCreate($date);
                $task->setDateDone(0);
                $em->persist($task);
                $em->flush();
            }
        }
        var_dump($csv->movecsv());
        return $this->render('csv/index.html.twig', [
            'controller_name' => 'CsvController',
        ]);
    }
}
