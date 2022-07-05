<?php

namespace App\DataFixtures;

use App\Entity\Measurement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MeasurementFixtures extends Fixture
{
    public const MEASUREMENTS = [
        ['name' => 'Poids', 'unity' => 'Kg'],
        ['name' => 'Épaule', 'unity' => 'cm'],
        ['name' => 'Bras droit', 'unity' => 'cm'],
        ['name' => 'Bras gauche', 'unity' => 'cm'],
        ['name' => 'Poitrine', 'unity' => 'cm'],
        ['name' => 'Ventre', 'unity' => 'cm'],
        ['name' => 'Ventre contracté', 'unity' => 'cm'],
        ['name' => 'Milieu fessier', 'unity' => 'cm'],
        ['name' => 'Cuisse droite', 'unity' => 'cm'],
        ['name' => 'Cuisse Gauche', 'unity' => 'cm'],

    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::MEASUREMENTS as $key => $measurementClient) {
            $measurement = new Measurement();
            $measurement->setName($measurementClient['name']);
            $measurement->setUnity($measurementClient['unity']);
            $this->addReference('measurement_' . $key, $measurement);
            $manager->persist($measurement);
        }
        $manager->flush();
    }
}
