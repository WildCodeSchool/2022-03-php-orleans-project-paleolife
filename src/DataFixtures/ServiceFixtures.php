<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

class ServiceFixtures extends Fixture
{
    public const SERVICES = [
        [
            'title' => 'Personal Training',
            'question' => 'Et si vous voulez vous sentir libre dans votre corps ?',
            'description' => 'Je vous accompagne, vous guide et vous encourage dans la réussite de votre challenge
            sportif. Un coach juste pour vous pendant une heure, j’anime avec un large choix
            d’activité adaptées à des capacités diverses. Découvrez ses nouvelles sensations de
            bien-être et de satisfaction. Plaisir et régularité sont des ingrédients essentiels pour
            obtenir vos résultats.',
        ],
        [
            'title' => 'Suivis à distance',
            'question' => 'Et si votre entraînement était sur mesure ?',
            'description' => 'À la maison ou à la salle de sport, cette offre s’adresse précisément à vous qui souhaitez
            mettre toutes les chances de votre côté. Idéal pour une première transformation
            physique. Je vous propose de structurer votre temps d’entraînement, avec un programme
            et plan diététique évolutif et spécialisé. Cela vous évitera de perdre un temps considérable qui,
             à la longue, pèsera sur votre motivation',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        $filesystem = new Filesystem();
        $filesystem->remove('public/uploads/service');
        $filesystem->mkdir('public/uploads/service');

        foreach (self::SERVICES as $key => $serviceName) {
            $service = new Service();
            $service->setTitle($serviceName['title']);
            $service->setQuestion($serviceName['question']);
            $service->setDescription($serviceName['description']);
            $photo = 'personnal' . $key . '.jpg';
            copy('src/DataFixtures/' . $photo, 'public/uploads/service/' . $photo);
            $service->setPhoto($photo);
            $manager->persist($service);
        }
        $manager->flush();
    }
}
