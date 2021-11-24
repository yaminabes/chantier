<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Unite;
use Faker;

class UniteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $unites = array('Tonne', 'Kilogramme', 'gramme', 'Pieces', 'metre');
        $faker = Faker\Factory::create('fr_FR');
        foreach ($unites as $i => $uni) {

            $unite[$i] = new Unite();
            $unite[$i]->setNomUnite($uni);
            //$unite[$i]->$unite($uni);
            //$unite[$i]->setUnite($faker->numerify);


            $manager->persist($unite[$i]);
        }
        $manager->flush();
    }
}
