<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\TypeBatiment;

class TypeBatimentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $typeBatiments = array('Maison traditionel', 'Immeuble', 'Piscine', 'Villa', 'Chalet', 'Entrepot', 'Chateau');

        foreach ($typeBatiments as $i => $typebat) {

            $typeBatiment[$i] = new TypeBatiment();
            $typeBatiment[$i]->setNomType($typebat);


            $manager->persist($typeBatiment[$i]);
        }
        $manager->flush();
    }
}
