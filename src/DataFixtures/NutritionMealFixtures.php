<?php

namespace App\DataFixtures;

use App\Entity\NutritionMeal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NutritionMealFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < UserFixtures::CLIENT_NUMBER; $i++) {
            $nutrition = new NutritionMeal();
            $nutrition->setMealName($faker->name());
            $nutrition->setProteins($faker->numberBetween(1000, 3000));
            $nutrition->setLipids($faker->numberBetween(0, 3000));
            $nutrition->setCarbohydrate($faker->numberBetween(0, 3000));
            $nutrition->setClient($this->getReference('client_' . $i));
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
