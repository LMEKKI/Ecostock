<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DataSheet;
use App\Entity\Category;


class DataSheetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'Pizza' => 'pizza',
            'Burger' => 'burger',
            'Salade' => 'salade',
            'Dessert' => 'dessert',
            'Boissons soft' => 'boissons soft',
            'Boissons alcoolisées' => 'boissons alcoolisées',
            'Entrées' => 'entrees',
            'Boissons chaudes' => 'boissons chaudes',
        ];

        // Récupérer les catégories existantes
        $categoryRepo = $manager->getRepository(Category::class);
        $categoryObjects = [];
        foreach ($categories as $label => $rubrique) {
            $category = $categoryRepo->findOneBy(['rubrique' => $rubrique]);
            if ($category) {
                $categoryObjects[$rubrique] = $category;
            }
        }

        $dataSheets = [
            [
                'name' => 'Margherita',
                'ingredients' => [
                    'Pâte à pizza',
                    'Sauce tomate',
                    'Mozzarella',
                    'Basilic frais',
                    'Huile d\'olive',
                    'Sel',
                ],
                'description' => 'La pizza classique italienne avec une base de sauce tomate, mozzarella et basilic frais.',
                'image' => 'https://picsum.photos/seed/picsum/200/300',
                'category' => 'pizza',
            ],
            [
                'name' => 'Reine',
                'ingredients' => [
                    'Pâte à pizza',
                    'Sauce tomate',
                    'Mozzarella',
                    'Jambon',
                    'Champignons de Paris',
                    'Origan',
                ],
                'description' => 'Une pizza équilibrée à base de jambon et champignons.',
                'image' => 'https://picsum.photos/seed/picsum/200/300',
                'category' => 'pizza',
            ],
            // Ajoute d'autres recettes ici...
        ];

        foreach ($dataSheets as $dataSheetData) {
            $dataSheet = new DataSheet();
            $dataSheet->setName($dataSheetData['name']);
            $dataSheet->setIngredient($dataSheetData['ingredients']);
            $dataSheet->setDescription($dataSheetData['description']);
            $dataSheet->setImage($dataSheetData['image']);

            // Ajouter la catégorie correspondante
            if (isset($categoryObjects[$dataSheetData['category']])) {
                $dataSheet->addCategory($categoryObjects[$dataSheetData['category']]);
            }

            $manager->persist($dataSheet);
        }

        $manager->flush();
    }
}