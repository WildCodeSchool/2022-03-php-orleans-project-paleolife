<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $filesystem = new Filesystem();
        $filesystem->remove('public/uploads/client');
        $filesystem->mkdir('public/uploads/client');

        for ($i = 0; $i < UserFixtures::CLIENT_NUMBER; $i++) {
            $client = new Client();
            $photoBefore = 'PhotoBefore' . $i . 'jpg';
            copy('src/DataFixtures/PhotoBefore.jpg', 'public/uploads/client/' . $photoBefore);
            $client->setPhotoBefore($photoBefore);
            $photoAfter = 'PhotoAfter' . $i . 'jpg';
            copy('src/DataFixtures/PhotoAfter.jpg', 'public/uploads/client/' . $photoAfter);
            $client->setPhotoAfter($photoAfter);
            $client->setUser($this->getReference('client' . $i));
            $manager->persist($client);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [

            UserFixtures::class,
        ];
    }
}
