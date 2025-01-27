<?php

namespace App\DataFixtures;

use App\Entity\DataSheet;
use App\Entity\Ingredient;
use App\Entity\Unit;
use App\Entity\Weight;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    // Création des unités
    $grams = new Unit();
    $grams->setName('grams');
    $manager->persist($grams);

    $liters = new Unit();
    $liters->setName('liters');
    $manager->persist($liters);

    $pieces = new Unit();
    $pieces->setName('pieces');
    $manager->persist($pieces);

    // Création des ingrédients
    $flour = new Ingredient();
    $flour->setName('Flour')->setUnit($grams)->setWeight((new Weight())->setValue(500));
    $manager->persist($flour);

    $sugar = new Ingredient();
    $sugar->setName('Sugar')->setUnit($grams)->setWeight((new Weight())->setValue(200));
    $manager->persist($sugar);

    $milk = new Ingredient();
    $milk->setName('Milk')->setUnit($liters)->setWeight((new Weight())->setValue(1));
    $manager->persist($milk);

    $eggs = new Ingredient();
    $eggs->setName('Eggs')->setUnit($pieces)->setWeight((new Weight())->setValue(4));
    $manager->persist($eggs);

    $butter = new Ingredient();
    $butter->setName('Butter')->setUnit($grams)->setWeight((new Weight())->setValue(250));
    $manager->persist($butter);

    $chocolate = new Ingredient();
    $chocolate->setName('Chocolate')->setUnit($grams)->setWeight((new Weight())->setValue(300));
    $manager->persist($chocolate);

    $banana = new Ingredient();
    $banana->setName('Banana')->setUnit($pieces)->setWeight((new Weight())->setValue(3));
    $manager->persist($banana);

    $cream = new Ingredient();
    $cream->setName('Cream')->setUnit($liters)->setWeight((new Weight())->setValue(0.5));
    $manager->persist($cream);

    $cheese = new Ingredient();
    $cheese->setName('Cheese')->setUnit($grams)->setWeight((new Weight())->setValue(200));
    $manager->persist($cheese);

    $spinach = new Ingredient();
    $spinach->setName('Spinach')->setUnit($grams)->setWeight((new Weight())->setValue(300));
    $manager->persist($spinach);

    $chicken = new Ingredient();
    $chicken->setName('Chicken')->setUnit($grams)->setWeight((new Weight())->setValue(500));
    $manager->persist($chicken);

    $rice = new Ingredient();
    $rice->setName('Rice')->setUnit($grams)->setWeight((new Weight())->setValue(200));
    $manager->persist($rice);

    $tomato = new Ingredient();
    $tomato->setName('Tomato')->setUnit($pieces)->setWeight((new Weight())->setValue(5));
    $manager->persist($tomato);

    $onion = new Ingredient();
    $onion->setName('Onion')->setUnit($pieces)->setWeight((new Weight())->setValue(2));
    $manager->persist($onion);

    $oil = new Ingredient();
    $oil->setName('Oil')->setUnit($liters)->setWeight((new Weight())->setValue(0.1));
    $manager->persist($oil);

    $potato = new Ingredient();
    $potato->setName('Potato')->setUnit($pieces)->setWeight((new Weight())->setValue(4));
    $manager->persist($potato);

    // Création des catégories
    $dessertCategory = new Category();
    $dessertCategory->setName('Dessert');
    $manager->persist($dessertCategory);

    $breakfastCategory = new Category();
    $breakfastCategory->setName('Breakfast');
    $manager->persist($breakfastCategory);

    $mainDishCategory = new Category();
    $mainDishCategory->setName('Main Dish');
    $manager->persist($mainDishCategory);

    $snackCategory = new Category();
    $snackCategory->setName('Snack');
    $manager->persist($snackCategory);

    // Création des recettes
    $recipes = [
      [
        'name' => 'Chocolate Cake',
        'description' => 'Rich and moist chocolate cake.',
        'image' => 'chocolate_cake.jpg',
        'ingredients' => [$flour, $sugar, $butter, $eggs, $chocolate],
        'categories' => [$dessertCategory],
      ],
      [
        'name' => 'Banana Smoothie',
        'description' => 'Healthy and creamy banana smoothie.',
        'image' => 'banana_smoothie.jpg',
        'ingredients' => [$banana, $milk],
        'categories' => [$breakfastCategory],
      ],
      [
        'name' => 'Creamy Spinach Pasta',
        'description' => 'Delicious pasta with spinach and cream sauce.',
        'image' => 'spinach_pasta.jpg',
        'ingredients' => [$spinach, $cream, $cheese],
        'categories' => [$mainDishCategory],
      ],
      [
        'name' => 'Chicken Curry',
        'description' => 'Spicy and flavorful chicken curry.',
        'image' => 'chicken_curry.jpg',
        'ingredients' => [$chicken, $tomato, $onion, $oil],
        'categories' => [$mainDishCategory],
      ],
      [
        'name' => 'Potato Chips',
        'description' => 'Crispy homemade potato chips.',
        'image' => 'potato_chips.jpg',
        'ingredients' => [$potato, $oil],
        'categories' => [$snackCategory],
      ],
      // 10 autres recettes (similaire, ajuster ingrédients, images, catégories)
    ];

    foreach ($recipes as $data) {
      $recipe = new DataSheet();
      $recipe->setName($data['name'])
        ->setDescription($data['description'])
        ->setImage($data['image']);
      foreach ($data['ingredients'] as $ingredient) {
        $recipe->addIngredient($ingredient);
      }
      foreach ($data['categories'] as $category) {
        $recipe->addCategory($category);
      }
      $manager->persist($recipe);
    }

    $manager->flush();
  }
}
