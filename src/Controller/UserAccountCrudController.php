<?php

namespace App\Controller;

use App\Entity\UserAccount;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PasswordField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\PasswordHasher\Type\PasswordTypePasswordHasherExtension;

class UserAccountCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserAccount::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('username', 'Nom d\'utilisateur'),
            TextField::new('password', 'Mot de passe')->setFormType(PasswordType::class)->hideOnIndex(),
            ArrayField::new('roles', 'Roles')->setHelp('Ajouter les roles de l\'utilisateur (ex: ROLE_ADMIN, ROLE_USER)'),
            AssociationField::new('restaurant', 'Restaurant associé')->setHelp('Sélectionnez un restaurant pour cet utilisateur'),
        ];
    }
    
}
