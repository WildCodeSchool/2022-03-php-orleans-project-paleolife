<?php

namespace App\DataFixtures;

use App\Entity\Exercise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExerciseFixtures extends Fixture
{
    public const EXERCISE_NUMBER = 30;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i <= self::EXERCISE_NUMBER; $i++) {
            $exercise = new Exercise();
            $exercise->setName($faker->word());
            $exercise->setDuration($faker->word());
            $exercise->setRepetition($faker->randomDigitNotNull() . 'x' . $faker->randomDigitNotNull());
            $this->addReference('exercise_' . $i, $exercise);
            $manager->persist($exercise);
        }
        $manager->flush();
    }
}
