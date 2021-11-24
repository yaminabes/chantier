<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Phase;
use Faker;

class PhaseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $phase = new phase();
            $phase->setNomPhase('nom');
            $phase->setDateDebut($faker->dateTime);
            $phase->setDateFin($faker->dateTime);
            $manager->persist($phase);
        }

            $manager->flush();
    }
}
