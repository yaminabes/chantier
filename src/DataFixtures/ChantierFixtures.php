<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Chantier;


class ChantierFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        // create 5 Chantier
        for ($i = 0; $i < 5; $i++) {
            $chantier = new chantier();

            $chantier->setDateDebut(new \DateTime());
            $chantier->setDateFin(new \DateTime());
            $chantier->setAdresse('address');

            $manager->persist($chantier);
        }
    }
}
        /*$chantier = new chantier();

        $chantier->setDateDebut('12-11-2012',$dateDebut);
        $chantier->setDateFin('15-11-2012',$dateFin);

        $chantier->setAdresse('2 rue de Paris');

        $manager->persist($chantier);

        $manager->flush();
    }*/


/* // create 5 Chantier
       for ($i = 0; $i < 5; $i++) {
           $chantier = new chantier();

           $chantier->setDateDebut(new \DateTime());
           $chantier->setDateFin(new \DateTime());
           $chantier->setAdresse('address');

           $manager->persist($chantier);
       }*/
