<?php


namespace App\DataFixtures;

use App\Entity\Unit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UnitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Liste des unités à créer
        $units = [
            'grammes',
            'kilo',
            'millilitres',
            'litres',
        ];

        foreach ($units as $unitName) {
            $unit = new Unit();
            $unit->setName($unitName);

            // Persister l'unité
            $manager->persist($unit);
        }

        // Enregistrer toutes les unités dans la base de données
        $manager->flush();
    }
}
