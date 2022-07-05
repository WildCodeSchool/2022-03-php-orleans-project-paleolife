<?php

namespace App\DataFixtures;

use App\Entity\MeasurementClient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MeasurementClientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < UserFixtures::CLIENT_NUMBER; $i++) {
            for ($j = 0; $j < count(MeasurementFixtures::MEASUREMENTS); $j++) {
                $measurementClient = new MeasurementClient();
                $measurementClient->setValueBefore($faker->randomFloat(1, 10, 90));
                $measurementClient->setValueAfter($faker->randomFloat(1, 10, 90));
                $measurementClient->setClient($this->getReference('validateClient_' . $i));
                $measurementClient->setMeasurement($this->getReference('measurement_' . $j));
                $manager->persist($measurementClient);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClientFixtures::class,
            MeasurementFixtures::class,
        ];
    }
}
