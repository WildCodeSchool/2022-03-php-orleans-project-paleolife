<?php

namespace App\DataFixtures;

use App\Entity\Meal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MealFixtures extends Fixture implements DependentFixtureInterface
{
    public const MEAL_NUMBER = 4;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < UserFixtures::CLIENT_NUMBER; $i++) {
            for ($j = 0; $j < self::MEAL_NUMBER; $j++) {
                $meal = new Meal();
                $meal->setName($faker->name());
                $meal->setProteins($faker->numberBetween(0, 2000));
                $meal->setLipids($faker->numberBetween(0, 2000));
                $meal->setCarbohydrate($faker->numberBetween(0, 2000));
                $meal->setNutrition($this->getReference('nutrition_' . $j));
                $manager->persist($meal);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            NutritionFixtures::class,
        ];
    }
}
