<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\Tache1Type;
use App\Form\TachePrestataireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestataireInterfaceController extends AbstractController
{
    #[Route('/prestataire/interface', name: 'prestataire_interface')]
    public function index(): Response
    {
        $taches = $this->getDoctrine()->getManager()->getRepository(Tache::class)->findAll();
        $tachesUtiles = [];
        foreach ($taches as $t){
            if($t->getPrestataire() == $this->getUser()->getPrestataire()){
                array_push($tachesUtiles, $t);
            }
        }


        return $this->render('prestataire_interface/index.html.twig', [
            'taches' => $tachesUtiles,
        ]);
    }

    #[Route('prestataire/tache/{id}/edit', name: 'prestataire_tache_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Tache $tache): Response
    {
        $form = $this->createForm(TachePrestataireType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($tache->getStatut()->getNomStatut() == "Terminer" )
                $tache->setDateFin(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            $route = $request->headers->get('referer');

            return $this->redirect($route);
            //return $this->redirectToRoute('tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestataire_interface/edit.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }
}
