<?php

namespace App\DataFixtures;

use App\Entity\Exercise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExerciseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $exercise = new Exercise();
        $exercise->setName('Poids 8kg');
        $exercise->setDuration(2.30);
        $exercise->setRepetition('3x5');
        $manager->persist($exercise);

        $manager->flush();
    }
}
