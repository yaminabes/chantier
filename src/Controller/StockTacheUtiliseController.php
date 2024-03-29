<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Entity\StockTacheUtilise;
use App\Form\StockTacheUtiliseType;
use App\Repository\StockTacheUtiliseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conduc/stock/tache/utilise')]
class StockTacheUtiliseController extends AbstractController
{
    #[Route('/', name: 'stock_tache_utilise_index', methods: ['GET'])]
    public function index(StockTacheUtiliseRepository $stockTacheUtiliseRepository): Response
    {
        //dd($stockTacheUtiliseRepository->findAll());
        return $this->render('stock_tache_utilise/index.html.twig', [
            'stock_tache_utilises' => $stockTacheUtiliseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'stock_tache_utilise_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $stockTacheUtilise = new StockTacheUtilise();
        $form = $this->createForm(StockTacheUtiliseType::class, $stockTacheUtilise);
        $form->handleRequest($request);
        $stockManager = $this->getDoctrine()->getManager()->getRepository(Stock::class);
        $stocks = $stockManager->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach($stocks as $s){
                if($s == $stockTacheUtilise->getStock()){
                    $quantiteOriginale = $s->getQuantite();
                    $s->setQuantite($quantiteOriginale - $stockTacheUtilise->getQuantite() );
                    $entityManager->persist($s);
                }
            }
            $entityManager->persist($stockTacheUtilise);
            $entityManager->flush();

            return $this->redirectToRoute('stock_tache_utilise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stock_tache_utilise/new.html.twig', [
            'stock_tache_utilise' => $stockTacheUtilise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'stock_tache_utilise_show', methods: ['GET'])]
    public function show(StockTacheUtilise $stockTacheUtilise): Response
    {
        return $this->render('stock_tache_utilise/show.html.twig', [
            'stock_tache_utilise' => $stockTacheUtilise,
        ]);
    }

    #[Route('/{id}/edit', name: 'stock_tache_utilise_edit', methods: ['GET','POST'])]
    public function edit(Request $request, StockTacheUtilise $stockTacheUtilise): Response
    {
        $form = $this->createForm(StockTacheUtiliseType::class, $stockTacheUtilise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stock = $this->getDoctrine()->getManager()->getRepository(Stock::class)->findAll();
            foreach ($stock as $s){
                if($s == $stockTacheUtilise->getStock()){
                    $result = $s->getQuantite();
                    $result = $result - $stockTacheUtilise->getQuantite();
                    $s->setQuantite($result);
                    //dd($result);
                    $this->getDoctrine()->getManager()->persist($s);

                }
            }
            $this->getDoctrine()->getManager()->persist($stockTacheUtilise);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stock_tache_utilise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stock_tache_utilise/edit.html.twig', [
            'stock_tache_utilise' => $stockTacheUtilise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'stock_tache_utilise_delete', methods: ['POST'])]
    public function delete(Request $request, StockTacheUtilise $stockTacheUtilise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stockTacheUtilise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stockTacheUtilise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stock_tache_utilise_index', [], Response::HTTP_SEE_OTHER);
    }
}
