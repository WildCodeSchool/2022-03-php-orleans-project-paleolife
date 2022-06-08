<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $service = new Service();
        $service->setTitle('Personal Training');
        $service->setDescription('Lorem ipsum dolor sitamet, consecteturadipiscing elit. Suspendisse necjusto efficitur,
        varius leo vitae, 
        egestas nulla. In hac habitasse platea dictumst. Sed ac dolor facilisis, lacinia purus at, tristique lectus. 
        Ut tempus id ligula sit amet luctus.
        Quisque eget sem id lectus consectetur egestas. Fusce a efficitur justo. Aenean congue id justo vitae tempus. 
        Curabitur id augue nisi.
        Fusce sit amet leo ut nibh congue convallis eu consectetur dolor. Fusce vestibulum semper porta. ');
        $service->setPhoto('assets/images/');
        $manager->persist($service);

        $manager->flush();
    }
}
