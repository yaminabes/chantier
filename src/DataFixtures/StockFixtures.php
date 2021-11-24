<?php

namespace App\DataFixtures;

use App\Entity\Materiaux;
use App\Entity\Unite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stock;
use Faker;

class StockFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $materiauxs = $manager->getRepository(Materiaux::class)->findAll();

        $faker = Faker\Factory::create('fr_FR');
        $stocks = array('En cours', 'Suspendu', 'Terminer', 'Valider');
        foreach ($stocks as $i => $stok) {
            $stock[$i] = new Stock();
            $stock[$i]->setQuantite($faker->numerify);

            $materiaux[$i] = new Materiaux();

            $rand = array_rand($materiauxs);
            $stock[$i]->setMateriaux($materiauxs[$rand]);

            $manager->persist($stock[$i]);
        }
        $manager->flush();
    }
}
