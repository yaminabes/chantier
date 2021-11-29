<?php

namespace App\Controller;


use App\Entity\Phase;
use App\Entity\Statut;
use App\Form\PhaseType;
use App\Repository\PhaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;


#[Route('/conduc/phase')]
class PhaseController extends AbstractController
{

    #[Route('/', name: 'phase_index', methods: ['GET'])]
    public function index (PhaseRepository $phaseRepository): Response
    {
        ($phaseRepository->findAll());
        return $this->render('phase/index.html.twig', [
           'phases' => $phaseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'phase_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {

        $phase = new Phase();
        $form = $this->createForm(PhaseType::class, $phase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($phase);
            $entityManager->flush();

            return $this->redirectToRoute('phase_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('phase/new.html.twig', [
            'phase' => $phase,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'phase_show', methods: ['GET','POST'])]
    public function show(Phase $phase): Response
    {
        if(isset($_POST["id"])){

            $id = $_POST["id"];
            $phases = $this->getDoctrine()->getManager()->getRepository(Phase::class)->findAll();
            $status = $this->getDoctrine()->getManager()->getRepository(Statut::class)->findAll();
            $valide = null;
            //dd($status);

            foreach ($status as $s){
                if($s->getNomStatut()== "Validé"){
                    $valide = $s;
                }
            }
            foreach ($phases as $p){
                if($p->getId() == $id){
                    $p->setStatut($valide);
                    $this->getDoctrine()->getManager()->persist($p);
                }
            }
            $this->getDoctrine()->getManager()->flush();
        }


        return $this->render('phase/show.html.twig', [
            'phase' => $phase,
        ]);
    }
    #[Route('/{id}/edit', name: 'phase_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Phase $phase): Response
    {
        $form = $this->createForm(PhaseType::class, $phase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('phase_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('phase/edit.html.twig', [
            'phase' => $phase,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'phase_delete', methods: ['POST'])]
    public function delete(Request $request, Phase $phase): Response
    {
        if ($this->isCsrfTokenValid('delete'.$phase->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($phase);
            $entityManager->flush();
        }

        return $this->redirectToRoute('phase_index', [], Response::HTTP_SEE_OTHER);
    }


}
