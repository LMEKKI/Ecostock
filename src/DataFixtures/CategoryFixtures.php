<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\DataSheet;
use App\Entity\Section;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupérer les DataSheets, Sections et Types existants
        $dataSheets = $manager->getRepository(DataSheet::class)->findAll();
        $sections = $manager->getRepository(Section::class)->findAll();
        $types = $manager->getRepository(Type::class)->findAll();

        // Générer des catégories
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category();

            // Associer un nom unique pour chaque catégorie
            $category->setName('Catégorie ' . $i);

            // Associer des DataSheets aléatoires
            if (!empty($dataSheets)) {
                $randomDataSheets = $faker->randomElements($dataSheets, $faker->numberBetween(1, 3));
                foreach ($randomDataSheets as $dataSheet) {
                    $category->addDatasheet($dataSheet);
                }
            }

            // Associer des SectionRestaurant aléatoires
            if (!empty($sections)) {
                $randomSections = $faker->randomElements($sections, $faker->numberBetween(1, 2));
                foreach ($randomSections as $section) {
                    $category->addSection($section);
                }
            }

            // Associer des Types aléatoires
            if (!empty($types)) {
                $randomTypes = $faker->randomElements($types, $faker->numberBetween(1, 2));
                foreach ($randomTypes as $type) {
                    $category->getType($type);
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
            SectionFixtures::class,
        ];
    }
}
