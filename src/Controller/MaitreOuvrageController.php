<?php

namespace App\Controller;

use App\Entity\MaitreOuvrage;
use App\Form\MaitreOuvrageType;
use App\Repository\MaitreOuvrageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/maitre/ouvrage')]
class MaitreOuvrageController extends AbstractController
{
    #[Route('/', name: 'maitre_ouvrage_index', methods: ['GET'])]
    public function index(MaitreOuvrageRepository $maitreOuvrageRepository): Response
    {
        return $this->render('maitre_ouvrage/index.html.twig', [
            'maitre_ouvrages' => $maitreOuvrageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'maitre_ouvrage_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $maitreOuvrage = new MaitreOuvrage();
        $form = $this->createForm(MaitreOuvrageType::class, $maitreOuvrage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($maitreOuvrage);
            $entityManager->flush();

            return $this->redirectToRoute('maitre_ouvrage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maitre_ouvrage/new.html.twig', [
            'maitre_ouvrage' => $maitreOuvrage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'maitre_ouvrage_show', methods: ['GET'])]
    public function show(MaitreOuvrage $maitreOuvrage): Response
    {
        return $this->render('maitre_ouvrage/show.html.twig', [
            'maitre_ouvrage' => $maitreOuvrage,
        ]);
    }

    #[Route('/{id}/edit', name: 'maitre_ouvrage_edit', methods: ['GET','POST'])]
    public function edit(Request $request, MaitreOuvrage $maitreOuvrage): Response
    {
        $form = $this->createForm(MaitreOuvrageType::class, $maitreOuvrage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('maitre_ouvrage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maitre_ouvrage/edit.html.twig', [
            'maitre_ouvrage' => $maitreOuvrage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'maitre_ouvrage_delete', methods: ['POST'])]
    public function delete(Request $request, MaitreOuvrage $maitreOuvrage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maitreOuvrage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maitreOuvrage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('maitre_ouvrage_index', [], Response::HTTP_SEE_OTHER);
    }
}
