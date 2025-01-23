<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Tableau de noms d'ingrédients
        $ingredientNames = [
            'Farine',
            'Sucre',
            'Sel',
            'Poivre',
            'Oeufs',
            'Beurre',
            'Lait',
            'Crème',
            'Fromage',
            'Pain',
            'Riz',
            'Pâtes',
            'Tomates',
            'Carottes',
            'Pommes',
            'Bananes',
            'Oranges',
            'Citron',
            'Poulet',
            'Viande',
            'Poisson',
            'Huile',
            'Vinaigre',
            'Chocolat',
            'Miel',
            'Vanille',
            'Levure',
            'Ail',
            'Oignon',
            'Persil',
            'Basilic',
            'Menthe',
            'Thym',
            'Romarin',
            'Cannelle',
            'Curcuma',
            'Paprika',
            'Safran',
            'Champignons',
            'Noix',
            'Amandes',
            'Pistaches',
            'Lentilles',
            'Pois chiches',
            'Haricots',
            'Epinards',
            'Courgettes',
            'Aubergines',
            'Poivrons',
            'Brocolis',
            'Chou-fleur'
        ];

        // Création des ingrédients
        foreach ($ingredientNames as $name) {
            $ingredient = new Ingredient();
            $ingredient->setName($name);

            // Persister l'ingrédient
            $manager->persist($ingredient);
        }

        // Enregistrement des ingrédients dans la base de données
        $manager->flush();
    }
}
