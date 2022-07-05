<?php

namespace App\DataFixtures;

use App\Entity\Session;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SessionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $session = new Session();
            $session->setName($faker->sentence());
            $session->setNumber($faker->randomDigitNotNull());
            $manager->persist($session);
        }
        $manager->flush();
    }
}
