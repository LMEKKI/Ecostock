<?php
namespace App\DataFixtures;

use App\Entity\SectionRestaurant;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SectionRestaurantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer les types si nécessaire
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

        // Flush pour persister les types dans la base de données
        $manager->flush();

        // Création des sections de restaurants et association avec les types
        $section1 = new SectionRestaurant();
        $section1->setName('Le Gourmet');
        $section1->setAdresse('10 Rue des Délices, Paris');
        $section1->addType($typeRestaurant);  // Associer le type 'Restaurant'
        $section1->addType($typeGlacier);    // Ajouter un autre type si nécessaire
        $manager->persist($section1);

        $section2 = new SectionRestaurant();
        $section2->setName('Snack Express');
        $section2->setAdresse('5 Avenue de la Gare, Lyon');
        $section2->addType($typeSnack);  // Associer le type 'Snack'
        $manager->persist($section2);

        $section3 = new SectionRestaurant();
        $section3->setName('Bar des Amis');
        $section3->setAdresse('15 Boulevard des Fleurs, Marseille');
        $section3->addType($typeBar);  // Associer le type 'Bar'
        $manager->persist($section3);

        $section4 = new SectionRestaurant();
        $section4->setName('Bistro Moderne');
        $section4->setAdresse('22 Place Centrale, Bordeaux');
        $section4->addType($typeRestaurant);  // Associer le type 'Restaurant'
        $section4->addType($typeCreperie);   // Ajouter un autre type si nécessaire
        $manager->persist($section4);

        // Sauvegarde des données dans la base
        $manager->flush();
    }
}

