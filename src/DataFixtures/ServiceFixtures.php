<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public const SERVICES = [
        [
            'title' => 'Personal Training',
            'question' => 'Et si vous voulez vous sentir libre dans votre corps ?',
            'description' => 'Ressentez le pouvoir du sport, en vous octroyant les services d’un professionnel.
    Je vous accompagne, vous guide et vous encourage dans la réussite de votre challenge sportif.
    Un coach juste pour vous pendant une heure, j’anime avec un large choix
    d’activité adaptées à des capacités diverses.
    Mon objectif, vous faire tomber amoureux du sport, pour que vous découvriez ses 
    nouvelles sensations de bien-être et de satisfaction.
    Les cours ne vous arrêteront pas de vous surprendre et de vous dépasser.
    Plaisir et régularité sont des ingrédients essentiels pour obtenir vos résultats.',
            'photo' => ''
        ],
        [
            'title' => 'Suivis à distance',
            'question' => 'Et si votre entraînement était sur mesure ?',
            'description' => 'A la maison ou à la salle de sport, cette offre s’adresse précisément à vous qui 
            souhaitez mettre toutes les chances de votre côté.
            Une méthode conçu sur 16 semaines, idéal pour une première transformation physique.
             Je vous propose de structurer votre temps d’entraînement, un programme évolutif 
             avec des exercices adaptés et spécialisés.
             Cela vous évitera de perdre un temps considérable et qui, à la longue pèseront sur votre motivation.
             S’ajoute un plan diététique également personnalisé selon votre génétique et objectif.',
            'photo' => ''
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SERVICES as $serviceName) {
            $service = new Service();
            $service->setTitle($serviceName['title']);
            $service->setQuestion($serviceName['question']);
            $service->setDescription($serviceName['description']);
            $service->setPhoto($serviceName['photo']);
            $manager->persist($service);
        }
        $manager->flush();
    }
}
