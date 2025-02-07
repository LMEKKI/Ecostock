<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Form\SectionType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class CampingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Camping::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [

            TextField::new('name', 'Nom du Camping'),
            TextField::new('adresse', 'Adresse du Camping'),
            ArrayField::new('userAccounts', 'les Compte associé'),
            CollectionField::new('section', 'Nom de l\'Etablissement')
                ->setEntryType(SectionType::class)
                ->allowAdd() // Permet d'ajouter de nouvelles entrées
                ->allowDelete() // Permet de supprimer des entrées
                ->setFormTypeOptions([
                    'by_reference' => false, // Important pour les relations ManyToMany
                ]),
        ];
    }
}
