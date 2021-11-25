<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\Tache;
use Container6wakuBu\getTache1TypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class StatsController extends AbstractController
{
    #[Route('/conduc/stats', name: 'stats')]
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        $taches = $this->getDoctrine()->getManager()->getRepository(Tache::class)->findAll();
        $prestaires = $this->getDoctrine()->getManager()->getRepository(Prestataire::class)->findAll();
        $retards = array();

        foreach($prestaires as $p){
            $score = 0;
            foreach($p->getTaches()->getValues() as $t){
                if($t->getDateFin() > $t->getDuree()){
                    $score = $score+3;
                }
                elseif ($t->getDateFin() == $t->getDuree()){
                    $score = $score+1;
                }
                elseif($t->getDateFin() < $t->getDuree()){
                    $score = $score-1;
                }
            }
            array_push($retards, ["prestataire"=>$p->getNom(), "score"=>$score]);
        }
        $prestatairesScore = array();
        foreach ($retards as $p) {
            $prestatairesScore[] = $p["prestataire"];
        }
        $scores = array();
        foreach ($retards as $prestataire) {
            $scores[] = $prestataire["score"];
        }
        //dd($retards);
        $labels = [$prestatairesScore];
        $datasets = [$scores];

        $chart = $chartBuilder->createChart(Chart::TYPE_BAR );
        $chart->setData([
            'labels' => $labels[0],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'maxBarThickness' => '8',
                    'data' => $datasets[0],
                ],
            ],
        ]);

        $chart->setOptions(["scales"=>["beginAtZero"=>true]]);
        return $this->render('stats/index.html.twig', [
            'chart' => $chart,
            'taches' => $taches
        ]);
    }
}
