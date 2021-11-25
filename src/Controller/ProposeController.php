<?php

namespace App\Controller;

use App\Entity\Propose;
use App\Form\ProposeType;
use App\Repository\ProposeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conduc/propose')]
class ProposeController extends AbstractController
{
    #[Route('/', name: 'propose_index', methods: ['GET'])]
    public function index(ProposeRepository $proposeRepository): Response
    {
        return $this->render('propose/index.html.twig', [
            'proposes' => $proposeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'propose_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $propose = new Propose();
        $form = $this->createForm(ProposeType::class, $propose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($propose);
            $entityManager->flush();

            return $this->redirectToRoute('propose_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('propose/new.html.twig', [
            'propose' => $propose,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'propose_show', methods: ['GET'])]
    public function show(Propose $propose): Response
    {
        return $this->render('propose/show.html.twig', [
            'propose' => $propose,
        ]);
    }

    #[Route('/{id}/edit', name: 'propose_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Propose $propose): Response
    {
        $form = $this->createForm(ProposeType::class, $propose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('propose_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('propose/edit.html.twig', [
            'propose' => $propose,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'propose_delete', methods: ['POST'])]
    public function delete(Request $request, Propose $propose): Response
    {
        if ($this->isCsrfTokenValid('delete'.$propose->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($propose);
            $entityManager->flush();
        }

        return $this->redirectToRoute('propose_index', [], Response::HTTP_SEE_OTHER);
    }
}
