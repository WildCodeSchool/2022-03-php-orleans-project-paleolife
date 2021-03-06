<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Filesystem\Filesystem;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $filesystem = new Filesystem();
        $filesystem->remove('public/uploads/client');
        $filesystem->mkdir('public/uploads/client');
        $faker = Factory::create();

        for ($i = 0; $i < UserFixtures::CLIENT_NUMBER; $i++) {
            $client = new Client();
            $photoBefore = 'PhotoBefore' . $i . 'jpg';
            copy('src/DataFixtures/PhotoBefore.jpg', 'public/uploads/client/' . $photoBefore);
            $client->setPhotoBefore($photoBefore);
            $photoAfter = 'PhotoAfter' . $i . 'jpg';
            copy('src/DataFixtures/PhotoAfter.jpg', 'public/uploads/client/' . $photoAfter);
            $client->setPhotoAfter($photoAfter);
            $client->setGlobalName('Perte de poids');
            $client->setMonthName('Remise à niveau');
            $client->setDateBefore($faker->dateTime());
            $client->setDateAfter($faker->dateTime());
            $client->setObjectiveNutrition($faker->word());
            $client->setEnergyExpenditure($faker->numberBetween(1000, 3000));
            $client->setWater($faker->numberBetween(1, 3));
            $client->setUser($this->getReference('user_' . $i));
            $this->addReference('client_' . $i, $client);
            $this->addReference('validateClient_' . $i, $client);
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
