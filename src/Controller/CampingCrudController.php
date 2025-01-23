<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Entity\Section;
use App\Form\SectionRestaurantType;
use App\Form\SectionType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
