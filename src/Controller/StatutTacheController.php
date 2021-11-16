<?php

namespace App\Controller;

use App\Entity\StatutTache;
use App\Form\StatutTacheType;
use App\Repository\StatutTacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/tache')]
class StatutTacheController extends AbstractController
{
    #[Route('/', name: 'statut_tache_index', methods: ['GET'])]
    public function index(StatutTacheRepository $statutTacheRepository): Response
    {
        return $this->render('statut_tache/index.html.twig', [
            'statut_taches' => $statutTacheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'statut_tache_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $statutTache = new StatutTache();
        $form = $this->createForm(StatutTacheType::class, $statutTache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($statutTache);
            $entityManager->flush();

            return $this->redirectToRoute('statut_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_tache/new.html.twig', [
            'statut_tache' => $statutTache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'statut_tache_show', methods: ['GET'])]
    public function show(StatutTache $statutTache): Response
    {
        return $this->render('statut_tache/show.html.twig', [
            'statut_tache' => $statutTache,
        ]);
    }

    #[Route('/{id}/edit', name: 'statut_tache_edit', methods: ['GET','POST'])]
    public function edit(Request $request, StatutTache $statutTache): Response
    {
        $form = $this->createForm(StatutTacheType::class, $statutTache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('statut_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_tache/edit.html.twig', [
            'statut_tache' => $statutTache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'statut_tache_delete', methods: ['POST'])]
    public function delete(Request $request, StatutTache $statutTache): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutTache->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($statutTache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('statut_tache_index', [], Response::HTTP_SEE_OTHER);
    }
}
