<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\csv;
use DocRep;
use function Sentry\captureLastError;

class CsvController extends AbstractController
{
    /**
     * @Route("/csv", name="csv")
     *
     */

    public function index(csv $csv)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new DocRep\task();
        $date = date("Y-m-d H:i:s");


        if(isset($_FILES))
        {
            foreach($csv->movecsv() as $key => $item) {
                if($key != 'none')
                {
                    $task->setId(0);
                    $task->setName($key);
                    $task->setParams($item);
                    $task->setState('WAIT');
                    $task->setDateCreate($date);
                    $task->setDateDone(0);
                    $em->persist($task);
                    $em->flush();
                }
            }
        }
        return $this->render('csv/index.html.twig', [
            'controller_name' => 'CsvController',
        ]);
    }
}
