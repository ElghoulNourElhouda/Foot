<?php

namespace App\DataFixtures;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixture extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

    //initialisation
     $user = new Users();
     // remplir les attributs avec des données
     $user->setEmail('test@gmail.com');
     $password = $this->hasher->hashPassword($user, 'pass_1234');
     $user->SetRoles(array('ROLE_ADMIN'));
     $user->setPassword($password);
    // insertion des données dans un BD
    $manager->persist($user);
    // Actualiser le BD
    $manager->flush();
    }
}
