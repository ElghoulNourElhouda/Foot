<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UsersRepository;
use App\Repository\EquipeRepository;
class EquipeControllerTest extends WebTestCase
{

    //Test de la fonction afficher la liste des équipes
    public function testshowequipe(): void
    {
        // le client qui agit en tant que  navigateur
        $client = static::createClient();
        $container = $client->getContainer();
        $userRepository = static::getContainer()->get(UsersRepository::class);
       // récupérer l'utilisateur de test
        $testUser = $userRepository->findOneByEmail('test@gmail.com');
       // login in app
       $client->loginUser($testUser);
      // get after login
       $client->request('GET', '/equipe/showEquipe');
       // Valider une réponse réussie et du contenu
       $this->assertResponseIsSuccessful();
       $this->assertSelectorTextContains('h3', 'La liste des équipes');
    }
    //Test de la fonction ajouter équipe
    public function testaddequipe(): void
    {
        // le client qui agit en tant que  navigateur
        $client = static::createClient();
        $container = $client->getContainer();
        $userRepository = static::getContainer()->get(UsersRepository::class);
       // récupérer l'utilisateur de test
        $testUser = $userRepository->findOneByEmail('test@gmail.com');
       // login in app
       $client->loginUser($testUser);
      // get after login
       $client->request('POST', '/equipe/ajouterequipe');
       $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    
    

    //Pour afficher les statistiques d'un joueur par son équipe pour une saison donnée
    public function testshowestatistique(): void
    {
        // le client qui agit en tant que  navigateur
        $client = static::createClient();
        $container = $client->getContainer();
        $userRepository = static::getContainer()->get(UsersRepository::class);
       // récupérer l'utilisateur de test
        $testUser = $userRepository->findOneByEmail('test@gmail.com');
       // login in app
       $client->loginUser($testUser);

       $equipeRepository=static::getContainer()->get(EquipeRepository::class);
        $testequipe= $equipeRepository->findOneByNom('EST');
        $client->request('POST', '/equipe/showstatequipe/'.$testequipe->getId());
       $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
}
