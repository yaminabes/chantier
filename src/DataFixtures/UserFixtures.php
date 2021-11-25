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
        for ($i = 0; $i < 5; $i++) {
            $user = new User();

            $roles = array("conduc" => "conduc", "maitre" => "maitre", "prestataire" => "prestataire");
            $rand = array_rand($roles, 1);
            $role = $roles[$rand];
            $user->setNom($faker->name);
            $user->setEmail($faker->freeEmailDomain);
            $user->setPassword($faker->password);
            $user->setAdresse($faker->address);
            $user->setNumTel($faker->phoneNumber);
            $user->setRoleUser($role);
            $user->username = $faker->userName;



            $manager->persist($user);
        }
        $manager->flush();
    }

}
