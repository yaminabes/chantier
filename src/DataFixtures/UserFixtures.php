<?php

namespace App\DataFixtures;

use App\Entity\ConducteurTravaux;
use App\Entity\MaitreOuvrage;
use App\Entity\Prestataire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void

    {$faker = Faker\Factory::create('fr_FR');
        $mails = ["prestataire@mail.com", "conduc@mail.com", "maitre@mail.com"];
        $roles = ["prestataire", "conducteur de travaux", "maitre d'ouvrage"];
        $acces = [["ROLE_PRESTATAIRE"],["ROLE_CONDUC"],["ROLE_MAITRE"]];
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setNom($faker->name);
            $user->setEmail($mails[$i]);
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);
            $user->setAdresse($faker->address);
            $user->setNumTel($faker->phoneNumber);
            $user->setRoleUser($roles[$i]);
            $user->setRoles($acces[$i]);
            $user->username = $faker->userName;




            $manager->persist($user);
        }
        $manager->flush();
    }

}
