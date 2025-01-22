<?php

namespace App\DataFixtures;

use App\Entity\UserAccount;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAccountFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // Crée un tableau d'utilisateurs à ajouter
        $users = [
            ['username' => 'Idriss', 'password' => 'password123', 'roles' => ['ROLE_USER']],
            ['username' => 'Mekki', 'password' => 'securepassword', 'roles' => ['ROLE_USER']],
            ['username' => 'Phillipe', 'password' => 'adminpassword', 'roles' => ['ROLE_ADMIN']],
            ['username' => 'Mathis', 'password' => 'password123', 'roles' => ['ROLE_USER']],
        ];

        // Crée chaque utilisateur et l'ajoute à la base de données
        foreach ($users as $userData) {
            $user = new UserAccount();
            $user->setUsername($userData['username']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $userData['password']));
            $user->setRoles($userData['roles']);

            $manager->persist($user);
        }

        // Enregistre toutes les entités dans la base de données
        $manager->flush();
    }
}
