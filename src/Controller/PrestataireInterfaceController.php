<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestataireInterfaceController extends AbstractController
{
    #[Route('/prestataire/interface', name: 'prestataire_interface')]
    public function index(): Response
    {
        //dd($this->getUser());

        return $this->render('prestataire_interface/index.html.twig', [
            'controller_name' => 'PrestataireInterfaceController',
        ]);
    }
}
