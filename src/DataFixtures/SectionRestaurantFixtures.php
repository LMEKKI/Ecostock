<?php

namespace App\DataFixtures;

use App\Entity\SectionRestaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SectionRestaurantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de plusieurs restaurants avec des données statiques
        $section1 = new SectionRestaurant();
        $section1->setName('Le Gourmet');
        $section1->setAdresse('10 Rue des Délices, Paris');
        $section1->setType(['Restaurant']);

        $manager->persist($section1);

        $section2 = new SectionRestaurant();
        $section2->setName('Snack Express');
        $section2->setAdresse('5 Avenue de la Gare, Lyon');
        $section2->setType(['Snack']);

        $manager->persist($section2);

        $section3 = new SectionRestaurant();
        $section3->setName('Bar des Amis');
        $section3->setAdresse('15 Boulevard des Fleurs, Marseille');
        $section3->setType(['Bar']);

        $manager->persist($section3);

        $section4 = new SectionRestaurant();
        $section4->setName('Bistro Moderne');
        $section4->setAdresse('22 Place Centrale, Bordeaux');
        $section4->setType(['Restaurant', 'Bar']);

        $manager->persist($section4);

        // Ajoutez d'autres sections si nécessaire

        // Sauvegarde des données dans la base
        $manager->flush();
    }
}
