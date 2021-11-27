<?php

namespace App\DataFixtures;

use App\Entity\Statut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Phase;
use Faker;

class PhaseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $statuts = $manager->getRepository(Statut::class)->findAll();
        for ($i = 0; $i < 5; $i++) {
            $phase = new phase();
            $statut= new Statut();
            $statut->setNomStatut("A faire");
            $manager->persist($statut);
            $phase->setStatut($statut);
            $phase->setNomPhase($faker->randomLetter);
            $phase->setDateDebut($faker->dateTime);
            $phase->setDateFin($faker->dateTime);
            $manager->persist($phase);
        }

            $manager->flush();
    }
}
