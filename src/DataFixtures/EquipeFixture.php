<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Equipe;
use App\Entity\Joueur;
class EquipeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //initialisation
        $equipeA = new Equipe();
         // remplir les attributs avec des données
        $equipeA->setNom('EST');
        $equipeA->setNiveau('1');
        // insertion des données dans un BD
        $manager->persist($equipeA);

        $equipeB = new Equipe();
         // remplir les attributs avec des données
        $equipeB->setNom('ESS');
        $equipeB->setNiveau('1');
        // insertion des données dans un BD
        $manager->persist($equipeB);

        $equipeC= new Equipe();
         // remplir les attributs avec des données
        $equipeC->setNom('CSS');
        $equipeC->setNiveau('1');
        // insertion des données dans un BD
        $manager->persist($equipeC);
          // Actualiser le BD
        $manager->flush();
    }
}
