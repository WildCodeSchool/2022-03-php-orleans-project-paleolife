<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $client = new User();
        $client->setEmail('client@monsite.com');
        $client->setRoles(['ROLE_CLENT']);
        $client->setName('Kiki');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $client,
            'contributorpassword'
        );
        $client->setPassword($hashedPassword);
        $manager->persist($client);
        $this->addReference($client->getEmail(), $client);
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setName('Seb');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'adminpassword'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);
        $this->addReference($admin->getEmail(), $admin);
        $manager->flush();
    }
}
