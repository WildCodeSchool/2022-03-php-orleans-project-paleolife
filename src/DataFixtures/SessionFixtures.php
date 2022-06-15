<?php

namespace App\DataFixtures;

use App\Entity\Session;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SessionFixtures extends Fixture
{
    public const SESSION = [
        ['name' => 'Séances bas du corps', 'number' => 1],
        ['name' => 'Séances haut du corps', 'number' => 2],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SESSION as $sessionName) {
            $session = new Session();
            $session->setName($sessionName['name']);
            $session->setNumber($sessionName['number']);
            $manager->persist($session);
        }
        $manager->flush();
    }
}
