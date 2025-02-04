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
    for ($i = 0; $i < 10; $i++) {
      $category = new Category();
      $category->setName($faker->word);
      $manager->persist($category);
      $categories[] = $category;
    }

    // Création des fiches techniques
    for ($i = 0; $i < 10; $i++) {
      $dataSheet = new DataSheet();
      $dataSheet->setName($faker->sentence(3));
      $dataSheet->setDescription($faker->paragraph);
      $dataSheet->setImage($faker->imageUrl(640, 480, 'food', true));

      // Ajout de catégories à la fiche technique
      $assignedCategories = $faker->randomElements($categories, $faker->numberBetween(1, 3));
      foreach ($assignedCategories as $category) {
        $dataSheet->addCategory($category);
      }

      // Création des ingrédients
      for ($j = 0; $j < 5; $j++) {
        $ingredient = new Ingredient();
        $ingredient->setName($faker->word);
        $ingredient->setWeightValue($faker->randomFloat(2, 0.1, 10));
        $ingredient->setUnit($faker->randomElement($units));
        $ingredient->setDatasheet($dataSheet);
        $manager->persist($ingredient);
      }

      $manager->persist($dataSheet);
    }

    $manager->flush();
  }
}
