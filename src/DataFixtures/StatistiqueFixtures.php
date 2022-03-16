<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Statistique;
use App\Entity\Saison;
use App\Entity\Equipe;
use App\Entity\Joueur;
class StatistiqueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //initialisation
        $saison = new Saison();
        // remplir les attributs avec des données
        $saison->setDate('2021/2022');
        $manager->persist($saison);
        $equipe=new Equipe();
        $equipe->setNom('EST');
        $equipe->setNiveau('1');
        // insertion des données dans un BD
        $manager->persist($equipe);
       //initialisation
        $JoueurA = new Joueur();
        // remplir les attributs avec des données
        $JoueurA->setEmail('oussamaahmed@gmail.com');
        $JoueurA->setNom('oussamaahmed');
        $JoueurA->setPrenom('ben aliD');
        $JoueurA->setDatenaissance(new \dateTime('31-10-2000'));
        $JoueurA->setEquipe($equipe);
        // insertion des données dans un BD
        $manager->persist($JoueurA);
        //initialisation
        $stat = new Statistique();
        // remplir les attributs avec des données
        $stat->setNbrematchs('20');
        $stat->setNbrebuts('5');
        $stat->setNbreminutes('2000');
        $stat->setNbrepasses('3');
        $stat->setJoueur($JoueurA);
        $stat->setEquipe($equipe);
        $stat->setSaison($saison); 
        // insertion des données dans un BD
        $manager->persist($stat);
        // Actualiser le BD
        $manager->flush();
    }
}
