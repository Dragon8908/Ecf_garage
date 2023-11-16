<?php

namespace App\DataFixtures;

use App\Entity\Horaires;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HorairesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $horaires1 = new Horaires();
        $horaires1->setJour('Lun.');
        $horaires1->setOuvertureMatin('08:45');
        $horaires1->setFermetureMatin('12:00');
        $horaires1->setOuvertureAprem('14:00');
        $horaires1->setFermetureAprem('18:00');
        $manager->persist($horaires1);

        $horaires2 = new Horaires();
        $horaires2->setJour('Mar.');
        $horaires2->setOuvertureMatin('08:45');
        $horaires2->setFermetureMatin('12:00');
        $horaires2->setOuvertureAprem('14:00');
        $horaires2->setFermetureAprem('18:00');
        $manager->persist($horaires2);

        $horaires3 = new Horaires();
        $horaires3->setJour('Mer.');
        $horaires3->setOuvertureMatin('08:45');
        $horaires3->setFermetureMatin('12:00');
        $horaires3->setOuvertureAprem('14:00');
        $horaires3->setFermetureAprem('18:00');
        $manager->persist($horaires3);

        $horaires4 = new Horaires();
        $horaires4->setJour('Jeu.');
        $horaires4->setOuvertureMatin('08:45');
        $horaires4->setFermetureMatin('12:00');
        $horaires4->setOuvertureAprem('14:00');
        $horaires4->setFermetureAprem('18:00');
        $manager->persist($horaires4);

        $horaires5 = new Horaires();
        $horaires5->setJour('Ven.');
        $horaires5->setOuvertureMatin('08:45');
        $horaires5->setFermetureMatin('12:00');
        $horaires5->setOuvertureAprem('14:00');
        $horaires5->setFermetureAprem('18:00');
        $manager->persist($horaires5);

        $horaires6 = new Horaires();
        $horaires6->setJour('Sam.');
        $horaires6->setOuvertureMatin('08:45');
        $horaires6->setFermetureMatin('12:00');
        $horaires6->setOuvertureAprem('Fermé');
        $horaires6->setFermetureAprem('');
        $manager->persist($horaires6);

        $horaires7 = new Horaires();
        $horaires7->setJour('Dim.');
        $horaires7->setOuvertureMatin('Fermé');
        $horaires7->setFermetureMatin('');
        $horaires7->setOuvertureAprem('');
        $horaires7->setFermetureAprem('');
        $manager->persist($horaires7);

        $manager->flush();
    }
}