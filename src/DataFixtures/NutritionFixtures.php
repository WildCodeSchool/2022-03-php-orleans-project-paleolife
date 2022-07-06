<?php

namespace App\DataFixtures;

use App\Entity\Nutrition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NutritionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < UserFixtures::CLIENT_NUMBER; $i++) {
            $nutrition = new Nutrition();
            $nutrition->setObjective($faker->word());
            $nutrition->setEnergyExpenditure($faker->numberBetween(1000, 3000));
            $nutrition->setWater($faker->numberBetween(1, 3));
            $nutrition->setClient($this->getReference('client_' . $i));
            $this->addReference('nutrition_' . $i, $nutrition);
            $manager->persist($nutrition);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClientFixtures::class,
        ];
    }
}
