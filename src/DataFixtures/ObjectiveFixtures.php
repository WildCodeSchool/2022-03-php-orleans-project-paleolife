<?php

namespace App\DataFixtures;

use App\Entity\Objective;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ObjectiveFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $objective = new Objective();
        $objective->setGlobalName('Perte de poids');
        $objective->setMonthName('Remise à niveau');
        $manager->persist($objective);

        $manager->flush();
    }
}
