<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Chantier;
use Faker;

class ChantierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $chantier = new chantier();
            $chantier->setDateDebut($faker->dateTime);
            $chantier->setDateFin($faker->dateTime);
            $chantier->setAdresse($faker->address);

        $manager->persist($chantier);
        }
        $manager->flush();
    }
}
