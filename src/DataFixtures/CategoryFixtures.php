<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\DataSheet;
use App\Entity\Section;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupérer les données nécessaires pour les relations
        $dataSheets = $manager->getRepository(DataSheet::class)->findAll();
        $section = $manager->getRepository(Section::class)->findAll();
        $types = $manager->getRepository(Type::class)->findAll();

        // Générer des catégories
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category();

            // Associer un nom unique pour chaque catégorie
            $category->setName('Catégorie ' . $i);

            // Associer un DataSheet aléatoire (s'il existe)
            if (!empty($dataSheets)) {
                $randomDataSheet = $dataSheets[array_rand($dataSheets)];
                $category->setDatasheets($randomDataSheet);
            }

            // Associer des SectionRestaurant aléatoires
            if (!empty($section)) {
                $randomsection = (array) array_rand($section, min(2, count($section)));
                foreach ($randomsection as $index) {
                    $category->addSection($section[$index]);
                }
            }

            // Associer des Types aléatoires
            if (!empty($types)) {
                $randomTypes = (array) array_rand($types, min(2, count($types)));
                foreach ($randomTypes as $index) {
                    $category->getType()->add($types[$index]);
                }
            }

            // Persister l'entité
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            DataSheetFixtures::class,
            SectionFixtures::class,
            TypeFixtures::class,
        ];
    }
}
