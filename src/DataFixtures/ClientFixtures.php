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
            $client->setGlobalName('Perte de poids');
            $client->setMonthName('Remise à niveau');
            $client->setUser($this->getReference('client_' . $i));
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
