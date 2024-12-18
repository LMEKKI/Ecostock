<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Liste statique des types et des rubriques
        $rubriques = ['Pizza', 'Burger', 'Salade', 'Dessert', 'Boissons soft', 'Boissons alcoolisées', 'Entrées','Boissons chaudes'];
       

        // Création de plusieurs catégories pour l'exemple
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();

            // Attribuer des valeurs statiques aux rubriques
            $category->setRubrique($rubriques); // Idem pour les rubriques

            // Persist la catégorie dans la base de données
            $manager->persist($category);
        }

        // Enregistrer les données dans la base de données
        $manager->flush();
    }
}
