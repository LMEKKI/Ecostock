<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Type;
use App\Entity\SectionRestaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupérer tous les types et services (SectionRestaurant) existants
        $types = $manager->getRepository(Type::class)->findAll();
        $sectionRestaurants = $manager->getRepository(SectionRestaurant::class)->findAll();

        // Vérifier qu'il y a des données disponibles pour créer les relations
        if (empty($types)) {
            throw new \Exception('Aucun type trouvé dans la base de données. Ajoutez des fixtures pour l\'entité Type.');
        }

        if (empty($sectionRestaurants)) {
            throw new \Exception('Aucun service trouvé dans la base de données. Ajoutez des fixtures pour l\'entité SectionRestaurant.');
        }

        // Créer 10 catégories avec des relations aléatoires
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();

            // Associer 2 types aléatoires
            $randomTypes = array_rand($types, min(2, count($types))); // Prend au moins 2 si possible
            foreach ((array) $randomTypes as $index) {
                $category->getType()->add($types[$index]);
            }

            // Associer 2 services (SectionRestaurant) aléatoires
            $randomServices = array_rand($sectionRestaurants, min(2, count($sectionRestaurants))); // Prend au moins 2 si possible
            foreach ((array) $randomServices as $index) {
                $category->addService($sectionRestaurants[$index]);
            }

            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,              // Assurez-vous que TypeFixtures existe et est correctement configuré
            SectionRestaurantFixtures::class // Assurez-vous que SectionRestaurantFixtures existe également
        ];
    }
}
