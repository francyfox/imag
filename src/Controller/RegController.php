<?php

namespace App\Controller;

use DocRep\Agent as User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Auth\Registration;
use App\Services\Auth\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegController extends AbstractController
{
    /**
     * @Route("/reg", name="reg")
     */

    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $agent = new User();
        $user = new Registration();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration = $form->getData();
            $password = $passwordEncoder->encodePassword($agent, $user->getPlain());
            $registration->setHashPassword($password);

            xdebug_var_dump($registration->getUser());
            $em->persist($registration->getUser());
            $em->flush();

//            return $this->redirectToRoute('main');
        }

        return $this->render('reg/index.html.twig', [
            'controller_name' => 'RegController',
            'form' => $form->createView()
        ]);
    }
}
