<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UsersRepository;

class SaisonControllerTest extends WebTestCase
{

    //Test de la fonction afficher la liste des saisons
    public function testshowsaison(): void
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
        $client->request('GET', '/saison/showsaison');
        // Valider une réponse réussie et du contenu
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'La liste des saisons');

    }
    //Test de la fonction ajouter saison
    public function testaddsaison(): void
    {
            // le client qui agit en tant que  navigateur
            $client = static::createClient();
            $container = $client->getContainer();
            $userRepository = static::getContainer()->get(UsersRepository::class);
            // récupérer l'utilisateur de test
            $testUser = $userRepository->findOneByEmail('test@gmail.com');
            // login in app
            $client->loginUser($testUser);
            $client->request('POST', '/saison/ajoutersaison');
            $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
