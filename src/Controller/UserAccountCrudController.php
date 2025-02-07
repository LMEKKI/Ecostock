<?php


namespace App\Controller;

use App\Entity\Section;
use App\Entity\Camping;
use App\Entity\UserAccount;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\RequestStack;

class UserAccountCrudController extends AbstractCrudController
{
    private $entityManager;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

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
            AssociationField::new('camping'),
            AssociationField::new('section')

        ];
    }
}
