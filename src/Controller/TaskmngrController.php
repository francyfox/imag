<?php

namespace App\Controller;

use App\Services\products;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use DocRep;


class TaskmngrController extends AbstractController
{

    /**
     * @Route("/taskmngr", name="taskmngr")
     */
    public function index()
    {
        $task = new DocRep\task();
        $em = $this->getDoctrine()->getManager()->getRepository('App:task');
        $obj = $em->findAll();

        if (!$obj) {
            throw $this->createNotFoundException(
                'No tasks found'
            );
        }

        return $this->render('taskmngr/index.html.twig', [
            'controller_name' => 'TaskmngrController',
            'obj' => $obj
        ]);
    }

    /**
     * @Route("/taskmngr/{id}/{status}", )
     */
    public function change(int $id, string $status)
    {
        if ($status == 'run'){
            var_dump($status);
            $em = $this->getDoctrine()->getManager()->getRepository('App:task');
            $post = $em->find($id);
            $post->setState('ACCEPTED');
            $this->getDoctrine()->getManager()->flush();
        }else{
            $em = $this->getDoctrine()->getManager()->getRepository('App:task');
            $post = $em->find($id);
            $this->getDoctrine()->getManager()->remove($post);
            $this->getDoctrine()->getManager()->flush();
        }

        products::reload('taskmngr');
    }
}
