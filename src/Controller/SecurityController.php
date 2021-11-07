<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
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

    public function registration(/*Request $request, ObjectManager $manager*/){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        /*$form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist(user);
            $manager->flush();
        }*/

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
