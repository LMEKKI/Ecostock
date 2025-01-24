<?php

namespace App\Controller;

use App\Entity\Section;
use App\Form\CampingType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\TypeType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
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
            AssociationField::new('camping')
                ->setFormTypeOptions([
                    'choice_label' => 'name',

                ]),
            AssociationField::new('type', 'Type associés')

                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
}
