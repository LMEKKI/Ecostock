<?php

namespace App\Controller;

use App\Entity\UserAccount;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAccountCrudController extends AbstractCrudController
{
    private $entityManager;
    private $requestStack;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return UserAccount::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('username', 'Nom d\'utilisateur'),
            TextField::new('plainPassword', 'Mot de passe')
                ->hideOnIndex(),
            AssociationField::new('camping', 'Camping associé'),
            AssociationField::new('section', 'Section associé'),
            ArrayField::new('roles', 'ajouter un role')
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entity): void
    {
        if ($entity instanceof UserAccount) {
            if ($entity->getPlainPassword()) {
                $hashedPassword = $this->passwordHasher->hashPassword($entity, $entity->getPlainPassword());
                $entity->setPassword($hashedPassword);
                $entity->setPlainPassword(null);
            }
        }

        parent::persistEntity($entityManager, $entity);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entity): void
    {
        if ($entity instanceof UserAccount) {
            if ($entity->getPlainPassword()) {
                $hashedPassword = $this->passwordHasher->hashPassword($entity, $entity->getPlainPassword());
                $entity->setPassword($hashedPassword);
                $entity->setPlainPassword(null);
            }
        }

        parent::updateEntity($entityManager, $entity);
    }
}
