<?php

namespace App\DataFixtures;

use App\Entity\Metier;
use App\Entity\Prestataire;
use App\Entity\Statut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Tache;
use Faker;

class TacheFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $statuts = $manager->getRepository(Statut::class)->findAll();
        $prestataires = $manager->getRepository(Prestataire::class)->findAll();
        $metiers = $manager->getRepository(Metier::class)->findAll();

        $taches = array('Effectuer le tracé de la future construction', 'Établir le fond de fouille', 'Installer le ferraillage', 'Lisser le béton');
        $faker = Faker\Factory::create('fr_FR');
        foreach ($taches as $i => $tach) {

            $tache[$i] = new Tache();
            $tache[$i]->setNomTache($tach);
            $tache[$i]->setTarifPrestation($faker->numerify);
            $rand = array_rand($statuts);
            $tache[$i]->setStatut($statuts[$rand]);

            $prestataire[$i] = new Prestataire();
            $rand = array_rand($prestataires);
            $tache[$i]->setPrestataire($prestataires[$rand]);

            $metier[$i] = new Metier();
            $rand = array_rand($metiers);
            $tache[$i]->setMetier($metiers[$rand]);
            $tache[$i]->setDateDebut($faker->dateTimeBetween("now", "+2years"));
            $tache[$i]->setDateFin($faker->dateTimeBetween("+2years", "+3years"));
            $tache[$i]->setDuree($faker->dateTimeBetween("now", "+4years"));

            $manager->persist($tache[$i]);
        }
        $manager->flush();
    }
}