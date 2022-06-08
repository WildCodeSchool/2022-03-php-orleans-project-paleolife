<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $service = new Service();
            $service->setTitle('Nom de catégorie ' . $i);
            $service->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam neque orci,
             suscipit quis eleifend at, auctor nec nisi. 
            Nunc porttitor auctor purus, in imperdiet nibh. Etiam mattis consequat mollis. Cras at rutrum enim. 
            Fusce iaculis elit sit amet enim aliquet bibendum.
            Integer vel urna eros. Integer fringilla at sapien eget dignissim. In semper quis dolor eu blandit. 
            Fusce dignissim diam ipsum, nec semper tellus dictum id.');
            $service->setPhoto("{{ asset('/build/images/placeholderservice.33708828.jpg') }}");
            $manager->persist($service);
        }

        $manager->flush();
    }
}
