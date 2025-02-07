<?php

namespace App\Controller;

use App\Entity\Section;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SectionRestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Section::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('adresse'),
            ArrayField::new('userAccounts', 'Compte associé'),

            AssociationField::new('camping')
                ->setFormTypeOptions([
                    'choice_label' => 'name',

                ]),
            ArrayField::new('type', 'Type associés'),
            AssociationField::new('type', 'Type associés')
                ->hideOnIndex()
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
}
