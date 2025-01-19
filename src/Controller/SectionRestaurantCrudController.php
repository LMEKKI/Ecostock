<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Entity\SectionRestaurant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\CampingType;
use App\Form\TypeType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SectionRestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SectionRestaurant::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('adresse'),
            ArrayField::new('camping', 'Camping associé')
                ->setEntryType(TypeType::class)
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
            CollectionField::new('type', 'Type associés')
                ->setEntryType(TypeType::class)
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }

    // Surcharge de la méthode persistEntity
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Vérifie si l'entité est une instance de SectionRestaurant
        if ($entityInstance instanceof SectionRestaurant) {
            // Récupérer le camping associé
            $camping = $entityInstance->getCamping()->first(); // Supposons que le premier camping est sélectionné

            // Si un camping est associé, récupérer son adresse
            if ($camping && $camping->getAdresse()) {
                $entityInstance->setAdresse($camping->getAdresse());
            }
        }

        // Appeler la méthode parente pour persister l'entité
        parent::persistEntity($entityManager, $entityInstance);
    }
}
