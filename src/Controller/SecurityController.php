<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */

    public function registration(Request $request){
        $user = new User();
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user->setAdresse("adresse");
            $user->setNumTel("094238");
            $user->setRoles(["ROLE_USER"]);
            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
