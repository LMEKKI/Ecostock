<?php

namespace App\Controller;

use App\Entity\SectionRestaurant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\CampingType;


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
            
            CollectionField::new('camping', 'Camping associé')
            ->setEntryType(CampingType::class)
            ->setFormTypeOptions([
                'by_reference' => false, // Important pour les relations ManyToMany
            ]),

            AssociationField::new('types', 'Types associés')
            ->setFormTypeOptions(['expanded' => true, 'multiple' => true, 'required' => true]) // Afficher en cases à cocher
            ->setHelp('Sélectionnez les types associés à cette section'),

        ];
    }

    
    
}
