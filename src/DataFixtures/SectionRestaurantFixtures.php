<?php

namespace App\DataFixtures;

use App\Entity\SectionRestaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SectionRestaurantFixtures extends Fixture
{

    public const SECTION_RESTAURANTS_REFERENCE_TAG = 'section-restaurants-';


    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
      
        $sectionRestaurantsData = [
            [
                'sectionRestaurantName' => 'CroustiBar',
                'sectionRestaurantAdresse' => 'CroustiCamping, 14 rue du camping, allée du bar',
                'admin' => null,
            ],
            [
                'sectionRestaurantName' => 'Restaurant du Crousti Chèvre',
                'sectionRestaurantAdresse' => 'CroustiCamping, 14 rue du camping, allée du restaurant',
                'admin' => null,
            ],
            [
                'sectionRestaurantName' => 'Idriss Bar à Cocktails',
                'sectionRestaurantAdresse' => 'le camping d\'Idriss, 7 rue du camping, allée du bar',
                'admin' => null,
            ],
            [
                'sectionRestaurantName' => 'Idriss Bar de piscine',
                'sectionRestaurantAdresse' => 'le camping d\'Idriss, 7 rue du camping, piscine',
                'admin' => null,
            ],[
                'sectionRestaurantName' => 'Idriss Restaurant',
                'sectionRestaurantAdresse' => 'le camping d\'Idriss, 7 rue du camping, allée du restaurant',
                'admin' => null,
            ],
            [
                'sectionRestaurantName' => 'Restaurant Didi',
                'sectionRestaurantAdresse' => 'LE CAMPING DE LMEKKI, 19 rue du camping, allée du restaurant',
                'admin' => null,
            ],
            [
                'sectionRestaurantName' => 'Bar à thé',
                'sectionRestaurantAdresse' => 'LE CAMPING DE LMEKKI, 19 rue du camping, allée du bar',
                'admin' => null,
            ],
            [
                'sectionRestaurantName' => 'Distributeur de MnMs',
                'sectionRestaurantAdresse' => 'au Buisson Campeur, 5bis rue du camping, allée principale',
                'admin' => null,
            ],
            [
                'sectionRestaurantName' => 'Pizzeria Buissoni',
                'sectionRestaurantAdresse' => 'au Buisson Campeur, 5bis rue du camping, allée des restaurant',
                'admin' => null,
            ]
        ];

        foreach ($sectionRestaurantsData as $i => $data) { 
            $sectionRestaurant = new SectionRestaurant();
            $sectionRestaurant->setName($data['sectionRestaurantName']);
            $sectionRestaurant->setAdresse($data['sectionRestaurantAdresse']);
            $manager->persist($sectionRestaurant);
            $this->addReference(self::SECTION_RESTAURANTS_REFERENCE_TAG . $i, $sectionRestaurant);
        }

        $manager->flush();
    }
}
