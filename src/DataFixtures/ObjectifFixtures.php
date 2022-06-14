<?php

namespace App\DataFixtures;

use App\Entity\Objectif;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ObjectifFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $objectif = new Objectif();
        $objectif->setGlobalName('Perte de poids');
        $objectif->setWeekName('Remise a niveau');
        $manager->persist($objectif);

        $manager->flush();
    }
}
