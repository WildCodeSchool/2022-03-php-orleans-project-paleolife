<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime as GlobalDateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Inflector\Rules\Word;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setName('Seb');
        $admin->setDate(
            GlobalDateTime::createFromFormat('!Y-m-d', '2022-7-4')
        );
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);
        $this->addReference($admin->getEmail(), $admin);
        $client = new User();
        $client->setEmail('client@monsite.com');
        $client->setRoles(['ROLE_CLIENT']);
        $client->setName('Fabrice');
        $client->setDate(
            GlobalDateTime::createFromFormat('!Y-m-d', '2022-10-4')
        );
        $hashedPassword = $this->passwordHasher->hashPassword(
            $client,
            'azerty'
        );
        $client->setPassword($hashedPassword);
        $manager->persist($client);
        $this->addReference($client->getEmail(), $client);

        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $aleaClient = new User();
            $aleaClient->setEmail($faker->email());
            $aleaClient->setRoles(['ROLE_CLIENT']);
            $aleaClient->setName($faker->name());
            $aleaClient->setDate($faker->dateTime());
            $hashedPassword = $this->passwordHasher->hashPassword(
                $aleaClient,
                $faker->sentence(
                    1,
                    true
                )
            );
            $aleaClient->setPassword($hashedPassword);
            $manager->persist($aleaClient);
        }
        $manager->flush();
    }
}
