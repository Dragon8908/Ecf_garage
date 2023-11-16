<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Voiture;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $voiture1 = new Voiture();
        $voiture1->setNom('Volkswaggen coccinelle');
        $voiture1->setPrix(4000);
        $voiture1->setAnnee(2018);
        $voiture1->setKm(20000);
        $voiture1->setImage('coccinelle.jpg');
        $voiture1->setCarburant('diesel');
        $manager->persist($voiture1);

        $voiture2 = new Voiture();
        $voiture2->setNom('Peugeot 208');
        $voiture2->setPrix(6000);
        $voiture2->setAnnee(2016);
        $voiture2->setKm(50000);
        $voiture2->setImage('peugeot-208.jpg');
        $voiture2->setCarburant('essence');
        $manager->persist($voiture2);

        $voiture3 = new Voiture();
        $voiture3->setNom('Renault Captur');
        $voiture3->setPrix(8000);
        $voiture3->setAnnee(2020);
        $voiture3->setKm(70000);
        $voiture3->setImage('renault-captur.jpg');
        $voiture3->setCarburant('hybride diesel/électrique');
        $manager->persist($voiture3);

        $voiture4 = new Voiture();
        $voiture4->setNom('Opel Corsa');
        $voiture4->setPrix(5500);
        $voiture4->setAnnee(2010);
        $voiture4->setKm(120000);
        $voiture4->setImage('opel-corsa.jpg');
        $voiture4->setCarburant('diesel');
        $manager->persist($voiture4);

        $voiture5 = new Voiture();
        $voiture5->setNom('Audi GT');
        $voiture5->setPrix(15000);
        $voiture5->setAnnee(2019);
        $voiture5->setKm(30000);
        $voiture5->setImage('audi-gt.jpg');
        $voiture5->setCarburant('électrique');
        $manager->persist($voiture5);

        $voiture6 = new Voiture();
        $voiture6->setNom('Land Rover Freelander');
        $voiture6->setPrix(7000);
        $voiture6->setAnnee(2003);
        $voiture6->setKm(180000);
        $voiture6->setImage('freelander.jpg');
        $voiture6->setCarburant('essence');
        $manager->persist($voiture6);

        $manager->flush();
    }
}
