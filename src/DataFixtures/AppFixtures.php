<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\DataSheet;
use App\Entity\Ingredient;
use App\Entity\Unit;
use App\Entity\Weight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    // Création des Unités
    $unitGrammes = new Unit();
    $unitGrammes->setName("grammes");
    $manager->persist($unitGrammes);

    $unitKilogrammes = new Unit();
    $unitKilogrammes->setName("kilogrammes");
    $manager->persist($unitKilogrammes);

    $unitCentilitres = new Unit();
    $unitCentilitres->setName("centilitres");
    $manager->persist($unitCentilitres);

    $unitMillilitres = new Unit();
    $unitMillilitres->setName("millilitres");
    $manager->persist($unitMillilitres);

    // Création des Poids
    $weight100g = new Weight();
    $weight100g->setWeight(100);
    $manager->persist($weight100g);

    $weight500g = new Weight();
    $weight500g->setWeight(500);
    $manager->persist($weight500g);

    $weight1kg = new Weight();
    $weight1kg->setWeight(1000);
    $manager->persist($weight1kg);

    $weight200g = new Weight();
    $weight200g->setWeight(200);
    $manager->persist($weight200g);

    $weight300g = new Weight();
    $weight300g->setWeight(300);
    $manager->persist($weight300g);
    $weight50g = new Weight();
    $weight50g->setWeight(50);
    $manager->persist($weight50g);

    // Création des Catégories
    $categoryPlatsPrincipaux = new Category();
    $categoryPlatsPrincipaux->setName("Plats principaux");
    $manager->persist($categoryPlatsPrincipaux);

    $categoryDesserts = new Category();
    $categoryDesserts->setName("Desserts");
    $manager->persist($categoryDesserts);

    $categoryEntrees = new Category();
    $categoryEntrees->setName("Entrées");
    $manager->persist($categoryEntrees);

    // Création des Recettes (DataSheets)
    $recipeSpaghettiBolognese = new DataSheet();
    $recipeSpaghettiBolognese->setName("Spaghetti à la Bolognese");
    $recipeSpaghettiBolognese->setDescription("Des pâtes avec une sauce bolognaise à base de viande hachée et de tomates.");
    $recipeSpaghettiBolognese->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipeSpaghettiBolognese);

    $recipePouletRoti = new DataSheet();
    $recipePouletRoti->setName("Poulet rôti");
    $recipePouletRoti->setDescription("Un poulet rôti accompagné de légumes.");
    $recipePouletRoti->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipePouletRoti);

    $recipeSaladeCesar = new DataSheet();
    $recipeSaladeCesar->setName("Salade César");
    $recipeSaladeCesar->setDescription("Une salade composée de laitue, poulet, croûtons et sauce César.");
    $recipeSaladeCesar->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipeSaladeCesar);

    $recipeRatatouille = new DataSheet();
    $recipeRatatouille->setName("Ratatouille");
    $recipeRatatouille->setDescription("Un mélange de légumes méditerranéens mijotés.");
    $recipeRatatouille->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipeRatatouille);

    $recipeTacos = new DataSheet();
    $recipeTacos->setName("Tacos");
    $recipeTacos->setDescription("Des tortillas garnies de viande hachée, légumes et sauce épicée.");
    $recipeTacos->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipeTacos);

    $recipeCrepes = new DataSheet();
    $recipeCrepes->setName("Crêpes");
    $recipeCrepes->setDescription("Des crêpes légères et sucrées.");
    $recipeCrepes->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipeCrepes);

    $recipePizzaMargherita = new DataSheet();
    $recipePizzaMargherita->setName("Pizza Margherita");
    $recipePizzaMargherita->setDescription("Pizza traditionnelle avec sauce tomate, mozzarella et basilic.");
    $recipePizzaMargherita->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipePizzaMargherita);

    $recipeSoupeOignon = new DataSheet();
    $recipeSoupeOignon->setName("Soupe à l'oignon");
    $recipeSoupeOignon->setDescription("Une soupe à base d'oignons caramélisés et de bouillon de viande.");
    $recipeSoupeOignon->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipeSoupeOignon);

    $recipeLasagne = new DataSheet();
    $recipeLasagne->setName("Lasagne");
    $recipeLasagne->setDescription("Des couches de pâtes, sauce bolognaise, béchamel et fromage.");
    $recipeLasagne->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipeLasagne);

    $recipeGateauChocolat = new DataSheet();
    $recipeGateauChocolat->setName("Gâteau au chocolat");
    $recipeGateauChocolat->setDescription("Un gâteau fondant au chocolat.");
    $recipeGateauChocolat->setImage("");  // Ajouter l'image manuellement
    $manager->persist($recipeGateauChocolat);

    // Création des Ingrédients
    $ingredientViandeHachee = new Ingredient();
    $ingredientViandeHachee->setName("Viande hachée");
    $ingredientViandeHachee->addUnit($unitKilogrammes);
    $ingredientViandeHachee->addWeight($weight500g);
    $manager->persist($ingredientViandeHachee);

    $ingredientPoulet = new Ingredient();
    $ingredientPoulet->setName("Poulet");
    $ingredientPoulet->addUnit($unitKilogrammes);
    $ingredientPoulet->addWeight($weight1kg);
    $manager->persist($ingredientPoulet);

    $ingredientTomates = new Ingredient();
    $ingredientTomates->setName("Tomates");
    $ingredientTomates->addUnit($unitGrammes);
    $ingredientTomates->addWeight($weight500g);
    $manager->persist($ingredientTomates);

    $ingredientSalade = new Ingredient();
    $ingredientSalade->setName("Laitue");
    $ingredientSalade->addUnit($unitGrammes);
    $ingredientSalade->addWeight($weight300g);
    $manager->persist($ingredientSalade);

    $ingredientCheddar = new Ingredient();
    $ingredientCheddar->setName("Cheddar");
    $ingredientCheddar->addUnit($unitGrammes);
    $ingredientCheddar->addWeight($weight200g);
    $manager->persist($ingredientCheddar);

    $ingredientFarine = new Ingredient();
    $ingredientFarine->setName("Farine");
    $ingredientFarine->addUnit($unitKilogrammes);
    $ingredientFarine->addWeight($weight1kg);
    $manager->persist($ingredientFarine);

    $ingredientOignons = new Ingredient();
    $ingredientOignons->setName("Oignons");
    $ingredientOignons->addUnit($unitGrammes);
    $ingredientOignons->addWeight($weight200g);
    $manager->persist($ingredientOignons);

    $ingredientBasilic = new Ingredient();
    $ingredientBasilic->setName("Basilic");
    $ingredientBasilic->addUnit($unitGrammes);
    $ingredientBasilic->addWeight($weight50g);
    $manager->persist($ingredientBasilic);

    $ingredientMozzarella = new Ingredient();
    $ingredientMozzarella->setName("Mozzarella");
    $ingredientMozzarella->addUnit($unitGrammes);
    $ingredientMozzarella->addWeight($weight300g);
    $manager->persist($ingredientMozzarella);

    $ingredientChocolat = new Ingredient();
    $ingredientChocolat->setName("Chocolat");
    $ingredientChocolat->addUnit($unitGrammes);
    $ingredientChocolat->addWeight($weight200g);
    $manager->persist($ingredientChocolat);

    // Relier les Ingrédients aux Recettes
    $recipeSpaghettiBolognese->addIngredient($ingredientViandeHachee);
    $recipeSpaghettiBolognese->addIngredient($ingredientTomates);

    $recipePouletRoti->addIngredient($ingredientPoulet);
    $recipePouletRoti->addIngredient($ingredientOignons);

    $recipeSaladeCesar->addIngredient($ingredientSalade);
    $recipeSaladeCesar->addIngredient($ingredientCheddar);

    $recipeRatatouille->addIngredient($ingredientTomates);
    $recipeRatatouille->addIngredient($ingredientOignons);

    $recipeTacos->addIngredient($ingredientViandeHachee);
    $recipeTacos->addIngredient($ingredientTomates);

    $recipeCrepes->addIngredient($ingredientFarine);
    $recipeCrepes->addIngredient($ingredientOignons);

    $recipePizzaMargherita->addIngredient($ingredientMozzarella);
    $recipePizzaMargherita->addIngredient($ingredientBasilic);

    $recipeSoupeOignon->addIngredient($ingredientOignons);
    $recipeSoupeOignon->addIngredient($ingredientBasilic);

    $recipeLasagne->addIngredient($ingredientViandeHachee);
    $recipeLasagne->addIngredient($ingredientMozzarella);

    $recipeGateauChocolat->addIngredient($ingredientChocolat);

    // On persiste les recettes et ingrédients dans la base
    $manager->flush();
  }
}
