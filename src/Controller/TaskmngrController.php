<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use DocRep;
use App\Services\csv;
use App\Services\products;
use App\Services\tasks\SetState;
use App\Commands\Console;


class TaskmngrController extends AbstractController
{

    private $path;

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @Route("/taskmngr", name="taskmngr")
     */
    public function index(csv $csv, Console $console)
    {
        $state = new SetState();
        $task = new DocRep\task();
        $em = $this->getDoctrine()->getManager()->getRepository('App:task');
        $obj = $em->findAll();

        if (!$obj) {
            throw $this->createNotFoundException(
                'No tasks found'
            );
        }else{
            return $this->render('taskmngr/index.html.twig', [
                'controller_name' => 'TaskmngrController',
                'obj' => $obj
            ]);
        }
    }



    /**
     * @Route("/taskmngr/{id}/{status}", )
     */
    public function change(int $id, string $status)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('App:task');
        $post = $em->find($id);


        if ($status == 'run'){
            $post->setState('ACCEPTED');
            $this->getDoctrine()->getManager()->flush();

        }
        else {
            $this->getDoctrine()->getManager()->remove($post);
            $this->getDoctrine()->getManager()->flush();
        }

        products::reload('taskmngr');
    }

    /**
     * @Route("/taskmngr/{status}", )
     */
    public function StartTasks(string $status)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('App:task');
        $path = $em->findOneBy(['state'=>'ACCEPTED']);

        if ($status == 'start' && isset($path))
        {
            $this->path = (get_object_vars($path))['params'];
            $TaskSerialize = serialize($this->path);
            file_put_contents('CsvPath', $TaskSerialize);

            try{
                $cmd = new Console();

                $cmd_csv = $cmd->execute(['systemctl', 'start', 'symcsv.service']);
                products::reload('main');
                return xdebug_var_dump($cmd_csv);
            }catch (Exception $e){
                xdebug_var_dump($e);
            }
        }
    }
}
