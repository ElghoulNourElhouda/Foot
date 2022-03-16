<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Saison;
class SaisonFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //initialisation
        $saison = new Saison();
        // remplir les attributs avec des données
        $saison->setDate('2019/2020');
        // insertion des données dans un BD
        $manager->persist($saison);
        // Actualiser le BD
        $manager->flush();
        
        $saisonb = new Saison();
        $saisonb->setDate('2014/2015');
        $manager->persist($saisonb);
        $manager->flush();
    }
}
