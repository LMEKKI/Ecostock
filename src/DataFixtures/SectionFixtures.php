<?php

namespace App\DataFixtures;

use App\Entity\Section;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SectionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer les types
        $typeRestaurant = new Type();
        $typeRestaurant->setName('Restaurant');
        $manager->persist($typeRestaurant);

        $typeBar = new Type();
        $typeBar->setName('Bar');
        $manager->persist($typeBar);

        $typeSnack = new Type();
        $typeSnack->setName('Snack');
        $manager->persist($typeSnack);

        $typeCreperie = new Type();
        $typeCreperie->setName('Crêperie');
        $manager->persist($typeCreperie);

        $typeGlacier = new Type();
        $typeGlacier->setName('Glacier');
        $manager->persist($typeGlacier);

        // Flush pour persister les types dans la base
        $manager->flush();

        // Création des sections avec association des campings
        $section1 = new Section();
        $section1->setName('Le Gourmet');
        $section1->setAdresse('10 Rue des Délices, Paris');
        $section1->addType($typeRestaurant); // Associer le type 'Restaurant'
        $section1->addType($typeGlacier); // Ajouter un autre type si nécessaire
        $section1->setCamping($this->getReference(CampingFixtures::CAMPINGS_REFERENCE_TAG . '0')); // Associer un camping
        $manager->persist($section1);

        $section2 = new Section();
        $section2->setName('Snack Express');
        $section2->setAdresse('5 Avenue de la Gare, Lyon');
        $section2->addType($typeSnack); // Associer le type 'Snack'
        $section2->setCamping($this->getReference(CampingFixtures::CAMPINGS_REFERENCE_TAG . '1')); // Associer un camping
        $manager->persist($section2);

        $section3 = new Section();
        $section3->setName('Bar des Amis');
        $section3->setAdresse('15 Boulevard des Fleurs, Marseille');
        $section3->addType($typeBar); // Associer le type 'Bar'
        $section3->setCamping($this->getReference(CampingFixtures::CAMPINGS_REFERENCE_TAG . '2')); // Associer un camping
        $manager->persist($section3);

        $section4 = new Section();
        $section4->setName('Bistro Moderne');
        $section4->setAdresse('22 Place Centrale, Bordeaux');
        $section4->addType($typeRestaurant); // Associer le type 'Restaurant'
        $section4->addType($typeCreperie); // Ajouter un autre type si nécessaire
        $section4->setCamping($this->getReference(CampingFixtures::CAMPINGS_REFERENCE_TAG . '3')); // Associer un camping
        $manager->persist($section4);

        // Sauvegarde des données dans la base
        $manager->flush();
    }
}
