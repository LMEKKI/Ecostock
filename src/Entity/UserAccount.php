<?php

namespace App\Entity;

use App\Repository\UserAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
class UserAccount implements UserInterface
{

    private ?int $id = null;
    private array $roles = [];
    private ?string $username = null;
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'userAccounts')]
    private ?Restaurant $restaurant = null;

    /**
     * @var Collection<int, OrderForm>
     */
    #[ORM\OneToMany(targetEntity: OrderForm::class, mappedBy: 'userAccount')]
    private Collection $orderForms;

    public function __construct()
    {
        $this->orderForms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): static
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection<int, OrderForm>
     */
    public function getOrderForms(): Collection
    {
        return $this->orderForms;
    }

    public function addOrderForm(OrderForm $orderForm): static
    {
        if (!$this->orderForms->contains($orderForm)) {
            $this->orderForms->add($orderForm);
            $orderForm->setUserAccount($this);
        }

        return $this;
    }

    public function removeOrderForm(OrderForm $orderForm): static
    {
        if ($this->orderForms->removeElement($orderForm)) {
            // set the owning side to null (unless already changed)
            if ($orderForm->getUserAccount() === $this) {
                $orderForm->setUserAccount(null);
            }
        }

        return $this;
    }


    public function getRoles(): array
    {
        return array_unique(array_merge($this->roles, ['ROLE_USER']));
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // Méthode pour effacer les données sensibles
    }

    public function getUserIdentifier(): string
    {
        // Remplace getUsername() pour identifier l'utilisateur
        return $this->username;
    }
}
