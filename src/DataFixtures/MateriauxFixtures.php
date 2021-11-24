<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Materiaux;
use App\Entity\Unite;


class MateriauxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $materiauxs = array('Le parpaing', 'Le béton', 'isolation thermique', 'Gaine electrique', 'Tuyau', 'Tuile', 'Carrelage');

        foreach ($materiauxs as $i => $materio) {

            $materiaux[$i] = new Materiaux();
            $materiaux[$i]->setNomMateriaux($materio);


            $manager->persist($materiaux[$i]);

        }
        $manager->flush();
    }
}
