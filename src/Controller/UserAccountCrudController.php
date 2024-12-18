<?php

namespace App\Controller;

use App\Entity\UserAccount;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;



class UserAccountCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserAccount::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('username', 'Nom d\'utilisateur'),
            TextField::new('password', 'Mot de passe')->setFormType(PasswordType::class)->hideOnIndex(),
            ArrayField::new('roles', 'Rôles'),
            AssociationField::new('camping', 'Camping associé')->setHelp('Sélectionnez un Camping pour cet utilisateur'),
            AssociationField::new('sectionrestaurant', 'Section restaurant associé')->setHelp('Sélectionnez une section pour cet utilisateur'),

        ];
    }
    




}
