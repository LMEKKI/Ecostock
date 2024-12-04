<?php

namespace App\DataFixtures;

use App\Entity\Camping;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampingsFixtures extends Fixture
{
    public const CAMPINGS_REFERENCE_TAG = 'campings-';

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $campingsData = [
            [
                'campingName' => 'CroustiCamping',
                'campingAdresse' => '14 rue du camping',
                'admin' => null,
            ],
            [
                'campingName' => 'le camping d\'Idriss',
                'campingAdresse' => '7 rue du camping',
                'admin' => null,
            ],
            [
                'campingName' => 'LE CAMPING DE LMEKKI',
                'campingAdresse' => '19 rue du camping',
                'admin' => null,
            ],
            [
                'campingName' => 'au Buisson Campeur',
                'campingAdresse' => '5bis rue du camping',
                'admin' => null,
            ]
        ];

        foreach ($campingsData as $i => $data) { 
            $camping = new Camping();
            $camping->setName($data['campingName']);
            $camping->setAdresse($data['campingAdresse']);
            $camping->setAdmin($data['admin']);
            $manager->persist($camping);
            $this->addReference(self::CAMPINGS_REFERENCE_TAG . $i, $camping);
        }

        $manager->flush();
    }
}
