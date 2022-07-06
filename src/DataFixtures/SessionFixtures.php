<?php

namespace App\DataFixtures;

use App\Entity\Session;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SessionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i < 20; $i++) {
            $session = new Session();
            $session->setName($faker->sentence());
            $session->setNumber($faker->randomDigitNotNull());
            $session->setComment($faker->sentence());
            $session->setClient($this->getReference('client_' . rand(1, UserFixtures::CLIENT_NUMBER - 1)));
            $session->addExercise($this->getReference('exercise_' . rand(0, ExerciseFixtures::EXERCISE_NUMBER)));
            $this->addReference('session_' . $i, $session);
            $manager->persist($session);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ClientFixtures::class,
            ExerciseFixtures::class,
        ];
    }
}
