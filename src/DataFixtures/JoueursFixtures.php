<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Equipe;
use App\Entity\Joueur;
class JoueursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //initialisation
        $equipe = new Equipe();
        // remplir les attributs avec des données
        $equipe->setNom('CAB');
        $equipe->setNiveau('1');
        // insertion des données dans un BD
        $manager->persist($equipe);

        $JoueurA = new Joueur();
        $JoueurA->setEmail('oussama@gmail.com');
        $JoueurA->setNom('oussama');
        $JoueurA->setPrenom('ben aliD');
        $JoueurA->setDatenaissance(new \dateTime('31-10-2000'));
        $JoueurA->setEquipe($equipe);
        $manager->persist($JoueurA);

        $JoueurB = new Joueur();
        $JoueurB->setEmail('khaled@gmail.com');
        $JoueurB->setNom('khaled');
        $JoueurB->setPrenom('ben mahmoud');
        $JoueurB->setDatenaissance(new \dateTime('03-12-2001'));
        $JoueurB->setEquipe($equipe);
        $manager->persist($JoueurB);
       // Actualiser le BD
        $manager->flush();
    }
}
