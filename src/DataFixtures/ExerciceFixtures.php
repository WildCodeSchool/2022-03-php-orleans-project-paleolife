<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExerciceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $exercice = new Exercice();
        $exercice->setName('Poids 8kg');
        $exercice->setDuration(2.30);
        $exercice->setRepetition('3x5');
        $manager->persist($exercice);

        $manager->flush();
    }
}
