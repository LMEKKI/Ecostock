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
    #[Assert\Length(min: 8)]
    private ?string $password = null;

    private ?string $plainPassword = null;


    #[ORM\ManyToOne(inversedBy: 'userAccounts')]
    private ?Camping $camping = null;

    #[ORM\ManyToOne(inversedBy: 'userAccount')]
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
        $this->orderForms = new ArrayCollection();
        $this->roles = ['ROLE_USER', 'ROLE_ADMIN']; // Initialisation par défaut

    }

    #[ORM\PrePersist]
    public function assignDefaultRole(): void
    {
        if (empty($this->roles)) {
            $this->roles[] = 'ROLE_USER'; // Attribue le rôle par défaut
        }
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUserIdentifier(): string
    {
        return $this->username ?? '';
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


    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }





    public function getCamping(): ?Camping
    {
        return $this->camping;
    }


    public function setCamping(?Camping $camping): static
    {
        $this->camping = $camping;
        return $this;
    }


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
            if ($orderForm->getUserAccount() === $this) {
                $orderForm->setUserAccount(null);
            }
        }
        return $this;
    }


    public function getRoles(): array
    {
        return array_unique($this->roles);
    }


    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }




    public function eraseCredentials(): void {}

    public function getUsername()
    {

        return $this->username   ?? '';
    }

    public function __toString(): string
    {
        return $this->username ?? '';
    }
}
