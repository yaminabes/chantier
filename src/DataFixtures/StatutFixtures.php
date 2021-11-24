<?php

namespace App\DataFixtures;

use App\Entity\Statut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\StatutTache;

class StatutFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //$statuts = $manager->getRepository(Statut::class)->findAll();

        $statuss = array('En cours', 'Suspendu', 'Terminer', 'Valider');
        foreach ($statuss as $i => $statu) {
            $status[$i] = new Statut();
            $status[$i]->setNomStatut($statu);

            $manager->persist($status[$i]);
        }

        $manager->flush();
    }
}
