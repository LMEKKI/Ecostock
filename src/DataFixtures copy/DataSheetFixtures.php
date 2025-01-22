<?php

namespace App\DataFixtures;

use App\Entity\DataSheet;
use App\Entity\Ingredient;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class DataSheetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupérer tous les ingrédients et catégories existants
        $ingredients = $manager->getRepository(Ingredient::class)->findAll();
        $categories = $manager->getRepository(Category::class)->findAll();

        // Tableau de descriptions et images pour les fiches
        $descriptions = [
            'Fiche technique pour un plat classique.',
            'Description détaillée pour une recette unique.',
            'Informations sur les ingrédients d\'une recette spéciale.',
            'Détails nutritionnels et instructions pour une préparation rapide.',
        ];
        $images = [
            'image1.jpg',
            'image2.jpg',
            'image3.jpg',
            'image4.jpg',
        ];

        // Création de 30 fiches
        for ($i = 1; $i <= 30; $i++) {
            $dataSheet = new DataSheet();
            $dataSheet->setName("Fiche technique $i");
            $dataSheet->setDescription($descriptions[array_rand($descriptions)]);
            $dataSheet->setImage($images[array_rand($images)]);

            // Ajouter aléatoirement 3 à 5 ingrédients
            $randomIngredients = (array) array_rand($ingredients, rand(3, 5));
            foreach ($randomIngredients as $index) {
                $dataSheet->addIngredient($ingredients[$index]);
            }



            // Persister la fiche
            $manager->persist($dataSheet);
        }

        // Enregistrer toutes les fiches dans la base de données
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            IngredientFixtures::class,
        ];
    }
}
