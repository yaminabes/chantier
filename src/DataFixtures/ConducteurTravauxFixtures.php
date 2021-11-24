<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ConducteurTravaux;
use Faker;

class ConducteurTravauxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $conducteurTravaux = new ConducteurTravaux();

            $conducteurTravaux->setPrenom($faker->userName);
            $conducteurTravaux->setNumeroMatricule($faker->numerify);

            $manager->persist($conducteurTravaux);
        }
        $manager->flush();
    }
}
