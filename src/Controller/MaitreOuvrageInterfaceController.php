<?php

namespace App\Controller;

use App\Entity\Chantier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaitreOuvrageInterfaceController extends AbstractController
{
    #[Route('/maitre/ouvrage/interface', name: 'maitre_ouvrage_interface')]
    public function index(): Response
    {
        $chantier = $this->getDoctrine()->getManager()->getRepository(Chantier::class)->findAll();
        $chantierUtilises = [];
        $user = $this->getUser();

        foreach ($chantier as $c){
            if($c->getMaitreOuvrage() == $user->getMaitreOuvrage() and $user->getMaitreOuvrage() != null){
                //dd($c->getMaitreOuvrage());
                array_push($chantierUtilises, $c);
            }
        }
        //dd($chantierUtilises);

        return $this->render('maitre_ouvrage_interface/index.html.twig', [
            'chantiers' => $chantierUtilises,
        ]);
    }
}
