<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Metier;

class MetierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $metiers = array('Maçon', 'Terrassier', 'Charpentier', 'Électricien', 'Plombier');

        foreach ($metiers as $i => $job) {

            $metier[$i] = new Metier;
            $metier[$i]->setCorpsMetier($job);


            $manager->persist($metier[$i]);
        }
        $manager->flush();
    }
}
