<?php

namespace App\Controller;

use App\Entity\ConducteurTravaux;
use App\Form\ConducteurTravauxType;
use App\Repository\ConducteurTravauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conducteur/travaux')]
class ConducteurTravauxController extends AbstractController
{
    #[Route('/', name: 'conducteur_travaux_index', methods: ['GET'])]
    public function index(ConducteurTravauxRepository $conducteurTravauxRepository): Response
    {
        //dd($conducteurTravauxRepository);
        return $this->render('conducteur_travaux/index.html.twig', [
            'conducteur_travauxes' => $conducteurTravauxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'conducteur_travaux_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $conducteurTravaux = new ConducteurTravaux();
        $form = $this->createForm(ConducteurTravauxType::class, $conducteurTravaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conducteurTravaux);
            $entityManager->flush();

            return $this->redirectToRoute('conducteur_travaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conducteur_travaux/new.html.twig', [
            'conducteur_travaux' => $conducteurTravaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'conducteur_travaux_show', methods: ['GET'])]
    public function show(ConducteurTravaux $conducteurTravaux): Response
    {
        return $this->render('conducteur_travaux/show.html.twig', [
            'conducteur_travaux' => $conducteurTravaux,
        ]);
    }

    #[Route('/{id}/edit', name: 'conducteur_travaux_edit', methods: ['GET','POST'])]
    public function edit(Request $request, ConducteurTravaux $conducteurTravaux): Response
    {
        $form = $this->createForm(ConducteurTravauxType::class, $conducteurTravaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conducteur_travaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conducteur_travaux/edit.html.twig', [
            'conducteur_travaux' => $conducteurTravaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'conducteur_travaux_delete', methods: ['POST'])]
    public function delete(Request $request, ConducteurTravaux $conducteurTravaux): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conducteurTravaux->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($conducteurTravaux);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conducteur_travaux_index', [], Response::HTTP_SEE_OTHER);
    }
}
