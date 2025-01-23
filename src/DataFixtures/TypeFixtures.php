<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public const TYPES_REFERENCE = 'type_reference_';

    public function load(ObjectManager $manager): void
    {
        // Liste des types de restaurants
        $types = [
            'Pizzeria',
            'Restaurant Gastronomique',
            'Fast Food',
            'Brasserie',
            'Bistrot',
            'Café',
            'Restaurant Vegan',
            'Restaurant de Fruits de Mer',
            'Restaurant Italien',
            'Restaurant Chinois',
        ];

        foreach ($types as $key => $typeName) {
            $type = new Type();
            $type->setName($typeName);

            $manager->persist($type);

            // Ajouter une référence pour les relier aux catégories
            $this->addReference(self::TYPES_REFERENCE . $key, $type);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,  // Dépend de TypeFixtures pour charger les types
            SectionFixtures::class, // Dépend de SectionRestaurantFixtures pour charger les services
        ];
    }
}
