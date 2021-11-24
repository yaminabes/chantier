<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MaitreOuvrage;
use Faker;
class MaitreOuvrageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $maitreOuvrage = new MaitreOuvrage();

            $maitreOuvrage->setNumeroClient($faker->numerify);
            $maitreOuvrage->setPrenom($faker->lastName);

            $manager->persist($maitreOuvrage);
        }
        $manager->flush();
    }
}
