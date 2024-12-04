<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DataSheet;

class DataSheetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        {
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
                ],
                [
                    'name' => 'Quatre Fromages',
                    'ingredients' => [
                        'Pâte à pizza',
                        'Sauce tomate',
                        'Mozzarella',
                        'Gorgonzola',
                        'Emmental râpé',
                        'Parmesan',
                    ],
                    'description' => 'Un mélange savoureux de quatre fromages fondants.',
                    'image' => 'https://picsum.photos/seed/picsum/200/300',
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
                ],
                [
                    'name' => 'Pepperoni',
                    'ingredients' => [
                        'Pâte à pizza',
                        'Sauce tomate',
                        'Mozzarella',
                        'Pepperoni',
                        'Origan',
                    ],
                    'description' => 'Une pizza épicée garnie de pepperoni croustillant.',
                    'image' => 'https://picsum.photos/seed/picsum/200/300',
                ],
                [
                    'name' => 'Végétarienne',
                    'ingredients' => [
                        'Pâte à pizza',
                        'Sauce tomate',
                        'Mozzarella',
                        'Poivrons',
                        'Courgettes',
                        'Oignons rouges',
                        'Champignons',
                    ],
                    'description' => 'Une explosion de saveurs et de couleurs avec des légumes frais.',
                    'image' => 'https://picsum.photos/seed/picsum/200/300',
                ],
                [
                    'name' => 'Hawaïenne',
                    'ingredients' => [
                        'Pâte à pizza',
                        'Sauce tomate',
                        'Mozzarella',
                        'Jambon',
                        'Ananas',
                    ],
                    'description' => 'Le mariage sucré-salé du jambon et de l’ananas.',
                    'image' => 'https://picsum.photos/seed/picsum/200/300',
                ],
                [
                    'name' => 'Marinara',
                    'ingredients' => [
                        'Pâte à pizza',
                        'Sauce tomate',
                        'Ail',
                        'Huile d\'olive',
                        'Origan',
                    ],
                    'description' => 'Une pizza simple sans fromage avec ail et huile d’olive.',
                    'image' => 'https://picsum.photos/seed/picsum/200/300',
                ],
                [
                    'name' => 'Quatre Saisons',
                    'ingredients' => [
                        'Pâte à pizza',
                        'Sauce tomate',
                        'Mozzarella',
                        'Jambon',
                        'Champignons',
                        'Artichauts',
                        'Olives noires',
                    ],
                    'description' => 'Une pizza représentant chaque saison avec des garnitures variées.',
                    'image' => 'https://picsum.photos/seed/picsum/200/300',
                ],
                [
                    'name' => 'Calzone',
                    'ingredients' => [
                        'Pâte à pizza',
                        'Sauce tomate',
                        'Mozzarella',
                        'Jambon',
                        'Champignons',
                        'Œuf',
                    ],
                    'description' => 'Une pizza pliée en chausson, garnie d’ingrédients généreux.',
                    'image' => 'https://picsum.photos/seed/picsum/200/300',
                ],
                [
                    'name' => 'BBQ Chicken',
                    'ingredients' => [
                        'Pâte à pizza',
                        'Sauce barbecue',
                        'Poulet grillé',
                        'Mozzarella',
                        'Oignons rouges',
                        'Coriandre',
                    ],
                    'description' => 'Une pizza audacieuse avec du poulet grillé et une sauce barbecue.',
                    'image' => 'https://picsum.photos/seed/picsum/200/300',
                ],
            ];

            foreach ($dataSheets as $dataSheetData) {
                $dataSheet = new DataSheet();
                $dataSheet->setName($dataSheetData['name']);
                $dataSheet->setIngredient($dataSheetData['ingredients']);
                $dataSheet->setDescription($dataSheetData['description']);
                $dataSheet->setImage($dataSheetData['image']);
                $manager->persist($dataSheet);
            }

            $manager->flush();
        }
    }
}
