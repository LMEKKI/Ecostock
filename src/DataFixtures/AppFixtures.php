<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\DataSheet;
use App\Entity\Ingredient;
use App\Entity\Unit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = Factory::create();

    // Création des unités
    $units = [];
    $unitNames = ['g', 'kg', 'ml', 'l'];
    foreach ($unitNames as $unitName) {
      $unit = new Unit();
      $unit->setName($unitName);
      $manager->persist($unit);
      $units[] = $unit;
    }

    // Création des catégories
    $categories = [];
    $categoryNames = ['Entrée', 'Plat principal', 'Dessert', 'Boisson'];
    foreach ($categoryNames as $categoryName) {
      $category = new Category();
      $category->setName($categoryName);
      $manager->persist($category);
      $categories[] = $category;
    }

    // Création des fiches techniques (recettes)
    $recipes = [
      [
        'name' => 'Salade César',
        'description' => 'Une salade composée de laitue romaine, de croûtons et de parmesan, assaisonnée de vinaigrette César.',
        'image' => 'https://example.com/images/salade-cesar.jpg',
        'categories' => ['Entrée'],
        'ingredients' => [
          ['name' => 'Laitue romaine', 'quantity' => 200, 'unit' => 'g'],
          ['name' => 'Croûtons', 'quantity' => 50, 'unit' => 'g'],
          ['name' => 'Parmesan', 'quantity' => 30, 'unit' => 'g'],
          ['name' => 'Vinaigrette César', 'quantity' => 50, 'unit' => 'ml'],
        ],
      ],
      [
        'name' => 'Spaghetti Bolognese',
        'description' => 'Un plat de pâtes italien classique avec une sauce à la viande.',
        'image' => 'https://example.com/images/spaghetti-bolognese.jpg',
        'categories' => ['Plat principal'],
        'ingredients' => [
          ['name' => 'Spaghetti', 'quantity' => 200, 'unit' => 'g'],
          ['name' => 'Viande hachée', 'quantity' => 300, 'unit' => 'g'],
          ['name' => 'Tomates', 'quantity' => 400, 'unit' => 'g'],
          ['name' => 'Oignon', 'quantity' => 1, 'unit' => 'g'],
          ['name' => 'Ail', 'quantity' => 2, 'unit' => 'g'],
        ],
      ],
      [
        'name' => 'Tiramisu',
        'description' => 'Un dessert italien classique à base de mascarpone, de café et de cacao.',
        'image' => 'https://example.com/images/tiramisu.jpg',
        'categories' => ['Dessert'],
        'ingredients' => [
          ['name' => 'Mascarpone', 'quantity' => 250, 'unit' => 'g'],
          ['name' => 'Café', 'quantity' => 100, 'unit' => 'ml'],
          ['name' => 'Cacao', 'quantity' => 20, 'unit' => 'g'],
          ['name' => 'Biscuits à la cuillère', 'quantity' => 200, 'unit' => 'g'],
        ],
      ],
      [
        'name' => 'Smoothie aux fruits',
        'description' => 'Une boisson rafraîchissante à base de fruits mélangés.',
        'image' => 'https://example.com/images/smoothie.jpg',
        'categories' => ['Boisson'],
        'ingredients' => [
          ['name' => 'Banane', 'quantity' => 1, 'unit' => 'g'],
          ['name' => 'Fraises', 'quantity' => 150, 'unit' => 'g'],
          ['name' => 'Yaourt', 'quantity' => 200, 'unit' => 'ml'],
          ['name' => 'Miel', 'quantity' => 20, 'unit' => 'g'],
        ],
      ],
    ];

    foreach ($recipes as $recipeData) {
      $dataSheet = new DataSheet();
      $dataSheet->setName($recipeData['name']);
      $dataSheet->setDescription($recipeData['description']);
      $dataSheet->setImage($recipeData['image']);

      // Ajout de catégories à la fiche technique
      foreach ($recipeData['categories'] as $categoryName) {
        $filteredCategories = array_values(array_filter($categories, fn($cat) => $cat->getName() === $categoryName));
        if (!empty($filteredCategories)) {
          $category = $filteredCategories[0];
          $dataSheet->addCategory($category);
        }
      }

      // Création des ingrédients
      foreach ($recipeData['ingredients'] as $ingredientData) {
        $ingredient = new Ingredient();
        $ingredient->setName($ingredientData['name']);
        $ingredient->setWeightValue($ingredientData['quantity']);
        $filteredUnits = array_values(array_filter($units, fn($u) => $u->getName() === $ingredientData['unit']));
        if (!empty($filteredUnits)) {
          $unit = $filteredUnits[0];
          $ingredient->setUnit($unit);
        }
        $ingredient->setDatasheet($dataSheet);
        $manager->persist($ingredient);
      }

      $manager->persist($dataSheet);
    }

    $manager->flush();
  }
}
