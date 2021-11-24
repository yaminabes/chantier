<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Fournisseur;
use Faker;

class FournisseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $fournissuer = new Fournisseur();

            $fournissuer->setNomFournisseur($faker->company);
            $fournissuer->setSiret($faker->uuid);

            $manager->persist($fournissuer);
        }
        $manager->flush();
    }
}
