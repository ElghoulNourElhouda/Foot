<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UsersRepository;
use App\Repository\JoueurRepository;
class JoueursControllerTest extends WebTestCase
{
  
    public function testshowjoueurs(): void
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
       $client->request('GET', '/joueurs/showjoueurs');
       // Valider une réponse réussie et du contenu
       $this->assertResponseIsSuccessful();
       $this->assertSelectorTextContains('h3', 'La liste des joueurs');
    }
 
    public function teststatiquejoueur(): void
    {
        // le client qui agit en tant que  navigateur
        $client = static::createClient();
        $container = $client->getContainer();
        $userRepository = static::getContainer()->get(UsersRepository::class);
        // récupérer l'utilisateur de test
        $testUser = $userRepository->findOneByEmail('test@gmail.com');
      // login in app
        $client->loginUser($testUser);
        $joueurRepository=static::getContainer()->get(JoueurRepository::class);
        $testjoueur= $joueurRepository->findOneByNom('khaled');
        $client->request('POST', '/joueurs/statiquejoueur/'.$testjoueur->getId());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    
    public function testaddjoueurs(): void
    {
         // le client qui agit en tant que  navigateur
        $client = static::createClient();
        $container = $client->getContainer();
        $userRepository = static::getContainer()->get(UsersRepository::class);
        $testUser = $userRepository->findOneByEmail('test@gmail.com');
      // login in app
        $client->loginUser($testUser);
        $client->request('POST', '/joueurs/ajouterjoueurs');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
