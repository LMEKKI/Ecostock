<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DataSheet;
use App\Entity\Ingredient;

class DataSheetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        {  $dataSheets = [
            [
                'name' => 'Margherita',
                'ingredients' => [
                    ['name' => 'Pâte à pizza', 'unit' => 'g', 'weight' => 250],
                    ['name' => 'Sauce tomate', 'unit' => 'g', 'weight' => 150],
                    ['name' => 'Mozzarella', 'unit' => 'g', 'weight' => 200],
                    ['name' => 'Basilic frais', 'unit' => 'g', 'weight' => 5],
                    ['name' => 'Huile d\'olive', 'unit' => 'mL', 'weight' => 10],
                    ['name' => 'Sel', 'unit' => 'g', 'weight' => 5],
                ],
                'description' => 'La pizza classique italienne avec une base de sauce tomate, mozzarella et basilic frais.',
                'image' => 'https://picsum.photos/seed/picsum/200/300',
            ],
            [
                'name' => 'Quatre Fromages',
                'ingredients' => [
                    ['name' => 'Pâte à pizza', 'unit' => 'g', 'weight' => 250],
                    ['name' => 'Sauce tomate', 'unit' => 'g', 'weight' => 150],
                    ['name' => 'Mozzarella', 'unit' => 'g', 'weight' => 100],
                    ['name' => 'Gorgonzola', 'unit' => 'g', 'weight' => 100],
                    ['name' => 'Emmental râpé', 'unit' => 'g', 'weight' => 100],
                    ['name' => 'Parmesan', 'unit' => 'g', 'weight' => 50],
                ],
                'description' => 'Un mélange savoureux de quatre fromages fondants.',
                'image' => 'https://picsum.photos/seed/picsum/200/300',
            ],
            // Ajoutez les autres recettes ici en suivant le même format...
        ];

            foreach ($dataSheets as $data) {
                $dataSheet = new DataSheet();
                $dataSheet->setName($data['name']);
                $dataSheet->setDescription($data['description']);
                $dataSheet->setImage($data['image']);

                foreach ($data['ingredients'] as $ingData) {
                    $ingredient = new Ingredient();
                    $ingredient->setName($ingData['name']);
                    $ingredient->setUnit($ingData['unit']);
                    $ingredient->setWeight($ingData['weight']);

                    $dataSheet->addIngredient($ingredient);
                    $manager->persist($ingredient);
                }

                $manager->persist($dataSheet);
            }

            $manager->flush();
        }
    }
}
