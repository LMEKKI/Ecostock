<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\SectionRestaurant;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Rubriques possibles
        $rubriquesList = [
            ['Entrées', 'Soupes'],
            ['Plats principaux', 'Viandes'],
            ['Desserts', 'Gâteaux'],
            ['Boissons', 'Cocktails'],
            ['Snacks', 'Sandwichs'],
            ['Petit déjeuner', 'Céréales'],
            ['Végétarien', 'Salades'],
            ['Fruits de mer', 'Poissons'],
            ['Pâtes', 'Pizzas'],
            ['Spécialités régionales', 'Traditionnel'],
        ];

        // Récupérer tous les Types et SectionRestaurant
        $types = $manager->getRepository(Type::class)->findAll();
        $sectionsRestaurants = $manager->getRepository(SectionRestaurant::class)->findAll();



        // Créer 10 catégories et les associer à des types et des services
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setRubrique($rubriquesList[$i % count($rubriquesList)]); // Associer une rubrique depuis la liste

            // Associer 2 types au hasard à la catégorie
            $randomTypes = array_rand($types, 2); // Choisir 2 types au hasard
            if (is_array($randomTypes)) {
                foreach ($randomTypes as $index) {
                    $category->addType($types[$index]);
                }
            } else {
                $category->addType($types[$randomTypes]);
            }

            // Associer 2 services (SectionRestaurant) à la catégorie
            $randomServices = array_rand($sectionsRestaurants, 2); // Choisir 2 services au hasard
            if (is_array($randomServices)) {
                foreach ($randomServices as $index) {
                    $category->addService($sectionsRestaurants[$index]);
                }
            } else {
                $category->addService($sectionsRestaurants[$randomServices]);
            }

            $manager->persist($category);
        }

        // Enregistrer les catégories dans la base de données
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,  // Dépend de TypeFixtures pour charger les types
            SectionRestaurantFixtures::class, // Dépend de SectionRestaurantFixtures pour charger les services
        ];
    }
}
