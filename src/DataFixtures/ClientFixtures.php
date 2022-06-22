<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < UserFixtures::CLIENT_NUMBER; $i++) {
            $client = new Client();
            $client->setPhotoBefore('/assets/images/photoBefore.jpg');
            $client->setUser($this->getReference('client' . $i));
            $manager->persist($client);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [

            UserFixtures::class,
        ];
    }
}
