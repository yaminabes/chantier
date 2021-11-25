<?php

namespace App\Controller;

use App\Entity\TypeBatiment;
use App\Form\TypeBatimentType;
use App\Repository\TypeBatimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conduc/type/batiment')]
class TypeBatimentController extends AbstractController
{
    #[Route('/', name: 'type_batiment_index', methods: ['GET'])]
    public function index(TypeBatimentRepository $typeBatimentRepository): Response
    {
        return $this->render('type_batiment/index.html.twig', [
            'type_batiments' => $typeBatimentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'type_batiment_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $typeBatiment = new TypeBatiment();
        $form = $this->createForm(TypeBatimentType::class, $typeBatiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeBatiment);
            $entityManager->flush();

            return $this->redirectToRoute('type_batiment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_batiment/new.html.twig', [
            'type_batiment' => $typeBatiment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'type_batiment_show', methods: ['GET'])]
    public function show(TypeBatiment $typeBatiment): Response
    {
        return $this->render('type_batiment/show.html.twig', [
            'type_batiment' => $typeBatiment,
        ]);
    }

    #[Route('/{id}/edit', name: 'type_batiment_edit', methods: ['GET','POST'])]
    public function edit(Request $request, TypeBatiment $typeBatiment): Response
    {
        $form = $this->createForm(TypeBatimentType::class, $typeBatiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_batiment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_batiment/edit.html.twig', [
            'type_batiment' => $typeBatiment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'type_batiment_delete', methods: ['POST'])]
    public function delete(Request $request, TypeBatiment $typeBatiment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeBatiment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeBatiment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_batiment_index', [], Response::HTTP_SEE_OTHER);
    }
}
