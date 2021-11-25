<?php

namespace App\Controller;

use App\Entity\Prestataire;
use App\Entity\Stock;
use App\Entity\Tache;
use Container6wakuBu\getTache1TypeService;
use phpDocumentor\Reflection\Types\Integer;
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
        //note des prestataires
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR );
        $chart->setData([
            'labels' => $labels[0],
            'datasets' => [
                [
                    'label' => 'Note des préstataires',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'maxBarThickness' => '8',
                    'data' => $datasets[0],
                ],
            ],
        ]);

        //stock
        $stock = $this->getDoctrine()->getManager()->getRepository(Stock::class)->findAll();


        $labels = [];
        $datasets = [];
        foreach($stock as $s){
            array_push($labels,$s->getMateriaux()->getNomMateriaux());
           array_push( $datasets , $s->getQuantite());
        }

        //dd(array_values($datasets));


        $chartStock = $chartBuilder->createChart(Chart::TYPE_BAR );
        $chartStock->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Stock actuel',
                    'backgroundColor' => 'rgb(25, 78, 232)',
                    'borderColor' => 'rgb(25, 78, 232)',
                    'maxBarThickness' => '8',
                    'data' => $datasets,
                ],
            ],
        ]);

        $chartStock->setOptions(["scales"=>["beginAtZero"=>true]]);
        return $this->render('stats/index.html.twig', [
            'chart' => $chart,
            'chartStock' => $chartStock,
            'taches' => $taches
        ]);
    }


}
