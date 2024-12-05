<?php

namespace App\Entity;

use App\Repository\UserAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert; //pour sécuriser les champs comme username et password.


#[ORM\Entity(repositoryClass: UserAccountRepository::class)]
class UserAccount implements UserInterface
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


    #[ORM\ManyToOne( inversedBy: 'userAccount')]
     //Il fallait assurer que la propriété sectionrestaurant existe dans l'entité UserAccount
    private ?SectionRestaurant $sectionrestaurant = null;

    public function getSectionrestaurant(): ?SectionRestaurant
    {
        return $this->sectionrestaurant;
    }

    public function setSectionrestaurant(?SectionRestaurant $sectionrestaurant): static
    {
        $this->sectionrestaurant = $sectionrestaurant;

        return $this;
    }


    #[ORM\OneToMany(targetEntity: OrderForm::class, mappedBy: 'userAccount')]
    private Collection $orderForms;

    #[ORM\ManyToOne(inversedBy: 'userAccounts')]
    private ?SectionRestaurant $SectionRestaurant = null;

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
     * Récupère le nom d'utilisateur.
     * (Déprécié : Utilisez getUserIdentifier() à la place)
     */
    public function getUsername(): ?string
    {
        trigger_deprecation('App\Entity\UserAccount', 'v1.0', 'Use getUserIdentifier() instead.');
        return $this->username;
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
    public function setPassword(string $password): static
    {
        $this->password = $password;
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

    public function getSectionRestaurant(): ?SectionRestaurant
    {
        return $this->SectionRestaurant;
    }

    public function setSectionRestaurant(?SectionRestaurant $SectionRestaurant): static
    {
        $this->SectionRestaurant = $SectionRestaurant;

        return $this;
    }
}
