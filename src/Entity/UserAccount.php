<?php

namespace App\Entity;

use App\Repository\UserAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert; //pour sécuriser les champs comme username et password.
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[ORM\Entity(repositoryClass: UserAccountRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'Ce nom d\'utilisateur est déjà utilisé.')]
class UserAccount implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $username = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'userAccounts')]
    private ?Camping $camping = null;

    #[ORM\ManyToOne(inversedBy: 'userAccount')]
    //Il fallait assurer que la propriété sectionrestaurant existe dans l'entité
    private ?Section $section = null;

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): static
    {
        $this->section = $section;

        return $this;
    }


    #[ORM\OneToMany(targetEntity: OrderForm::class, mappedBy: 'userAccount')]
    private Collection $orderForms;

    public function __construct()
    {
        // Initialise les collections pour les relations OneToMany
        $this->orderForms = new ArrayCollection();
    }

    /**
     * Récupère l'identifiant unique de l'utilisateur.
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Récupère l'identifiant principal de l'utilisateur.
     * Utilisé par Symfony pour l'authentification.
     */
    public function getUserIdentifier(): string
    {
        return $this->username ?? '';
    }

    /**
     * Définit le nom d'utilisateur.
     */
    public function setUsername(string $username): static
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Récupère le mot de passe de l'utilisateur.
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Définit le mot de passe de l'utilisateur.
     */
    public function setPassword(string $plainPassword, UserPasswordHasherInterface $passwordHasher): self
    {
        $this->password = $passwordHasher->hashPassword($this, $plainPassword);
        return $this;
    }

    /**
     * Récupère Camping associé à l'utilisateur.
     */
    public function getCamping(): ?Camping
    {
        return $this->camping;
    }

    /**
     * Associe un Camping à l'utilisateur.
     */
    public function setCamping(?Camping $camping): static
    {
        $this->camping = $camping;
        return $this;
    }

    /**
     * Récupère les commandes (OrderForms) associées à l'utilisateur.
     */
    public function getOrderForms(): Collection
    {
        return $this->orderForms;
    }

    /**
     * Ajoute une commande à l'utilisateur.
     * Met également à jour la relation inverse.
     */
    public function addOrderForm(OrderForm $orderForm): static
    {
        if (!$this->orderForms->contains($orderForm)) {
            $this->orderForms->add($orderForm);
            $orderForm->setUserAccount($this);
        }
        return $this;
    }

    /**
     * Supprime une commande de l'utilisateur.
     * Met également à jour la relation inverse.
     */
    public function removeOrderForm(OrderForm $orderForm): static
    {
        if ($this->orderForms->removeElement($orderForm)) {
            if ($orderForm->getUserAccount() === $this) {
                $orderForm->setUserAccount(null);
            }
        }
        return $this;
    }

    /**
     * Récupère les rôles de l'utilisateur.
     * Par défaut, tous les utilisateurs ont au moins le rôle "ROLE_USER".
     */
    public function getRoles(): array
    {
        return array_unique(array_merge($this->roles, ['ROLE_USER']));
    }

    /**
     * Définit les rôles de l'utilisateur.
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * Efface les données sensibles stockées dans l'entité (si nécessaire).
     * Appelée par Symfony après l'authentification.
     */
    public function eraseCredentials(): void
    {
        // Vous pouvez nettoyer des données sensibles ici, par exemple des tokens.
    }

    public function getUsername()
    {

        return $this->username   ?? '';
    }

    public function __toString(): string
    {
        return $this->username ?? '';
    }
}
