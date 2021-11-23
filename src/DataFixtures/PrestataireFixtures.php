<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Prestataire;
use Faker;

class PrestataireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $prestataire = new Prestataire();

            $prestataire->setPrenom($faker->lastName);
            $prestataire->setSiret($faker->companySuffix);

            $manager->persist($prestataire);
        }
        $manager->flush();
    }
}
