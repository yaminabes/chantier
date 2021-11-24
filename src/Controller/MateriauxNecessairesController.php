<?php

namespace App\Controller;

use App\Entity\MateriauxNecessaires;
use App\Form\MateriauxNecessairesType;
use App\Repository\MateriauxNecessairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/necessaire/materiaux')]
class MateriauxNecessairesController extends AbstractController
{
    #[Route('', name: 'materiaux_necessaires_index', methods: ['GET'])]
    #ParamConverter("id", class="MateriauxNecessaires", options={"id": "id"})
    public function index(MateriauxNecessairesRepository $materiauxNecessairesRepository): Response
    {
        return $this->render('materiaux_necessaires/index.html.twig', [
            'materiaux_necessaires' => $materiauxNecessairesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'materiaux_necessaires_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materiauxNecessaire = new MateriauxNecessaires();
        $form = $this->createForm(MateriauxNecessairesType::class, $materiauxNecessaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($materiauxNecessaire);
            $entityManager->flush();
            $route = $request->headers->get('referer');

            return $this->redirect($route);
            //return $this->redirectToRoute('materiaux_necessaires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materiaux_necessaires/new.html.twig', [
            'materiaux_necessaire' => $materiauxNecessaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'materiaux_necessaires_show', methods: ['GET'])]
    public function show(MateriauxNecessaires $materiauxNecessaire): Response
    {
        return $this->render('materiaux_necessaires/show.html.twig', [
            'materiaux_necessaire' => $materiauxNecessaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'materiaux_necessaires_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MateriauxNecessaires $materiauxNecessaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MateriauxNecessairesType::class, $materiauxNecessaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $route = $request->headers->get('referer');

            return $this->redirect($route);
            //return $this->redirectToRoute('materiaux_necessaires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materiaux_necessaires/edit.html.twig', [
            'materiaux_necessaire' => $materiauxNecessaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'materiaux_necessaires_delete', methods: ['POST'])]
    public function delete(Request $request, MateriauxNecessaires $materiauxNecessaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materiauxNecessaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($materiauxNecessaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('materiaux_necessaires_index', [], Response::HTTP_SEE_OTHER);
    }
}
