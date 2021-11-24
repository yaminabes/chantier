<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {$faker = Faker\Factory::create('fr_FR');
        /*for ($i = 0; $i < 5; $i++) {
            $user = new User();

            $user->setUsername($faker->userName);
            $user->setEmail($faker->safeEmailDomain);
            $user->setPassword($faker->password);
            $user->setAdresse($faker->address);
            $user->setNumTel($faker->phoneNumber);

            $manager->persist($user);
        }*/
        $manager->flush();
    }

}
