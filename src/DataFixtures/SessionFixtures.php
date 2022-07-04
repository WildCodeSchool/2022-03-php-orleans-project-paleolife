<?php

namespace App\DataFixtures;

use App\Entity\Session;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SessionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i < 5; $i++) {
            $session = new Session();
            $session->setName('séance bas du corps');
            $session->setNumber(2);
            $session->setClient($this->getReference('client_' . $i));
            $session->addExercise($this->getReference('exercise_' . $i));
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
