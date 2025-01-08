<?php

namespace App\Controller;

use App\Entity\SectionRestaurant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Validator\Constraints\Choice;

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
            ChoiceField::new('type', 'Type')->setChoices([
                'Restaurant' => 'Restaurant',
                'Bar' => 'Bar',
                'Snack' => 'Snack',
            ])
            ->allowMultipleChoices(true)
            ->renderExpanded(true),
            AssociationField::new('camping', 'Camping associé')->setHelp('Sélectionnez un Camping pour cette section'),
        ];
    }

    
    
}
