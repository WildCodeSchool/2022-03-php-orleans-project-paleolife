<?php

namespace App\DataFixtures;

use App\Entity\Nutrition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NutritionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nutrition = new Nutrition();

        $nutrition->setName('Petit déjeuner');

        $manager->persist($nutrition);

        $manager->flush();
    }
}
