<?php

namespace App\DataFixtures;

use App\Entity\Exercise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExerciseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i < 5; $i++) {
            $exercise = new Exercise();
            $exercise->setName($faker->word());
            $exercise->setDuration($faker->randomFloat(2, 1, 5));
            $exercise->setRepetition($faker->randomDigitNotNull() . 'x' . $faker->randomDigitNotNull());
            $this->addReference('exercise_' . $i, $exercise);
            $manager->persist($exercise);
        }
        $manager->flush();
    }
}
