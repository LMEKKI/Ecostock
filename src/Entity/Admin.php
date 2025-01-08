<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    private array $roles = [];
    private ?string $username= null;

    /**
     * @var Collection<int, Camping>
     */
    #[ORM\OneToMany(targetEntity: Camping::class, mappedBy: 'admin')]
    private Collection $camping;

    public function __construct()
    {
        $this->camping = new ArrayCollection();
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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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

    /**
     * @return Collection<int, Camping>
     */
    public function getCamping(): Collection
    {
        return $this->camping;
    }

    public function addCamping(Camping $camping): static
    {
        if (!$this->camping->contains($camping)) {
            $this->camping->add($camping);
            $camping->setAdmin($this);
        }

        return $this;
    }

    public function removeCamping(Camping $camping): static
    {
        if ($this->camping->removeElement($camping)) {
            // set the owning side to null (unless already changed)
            if ($camping->getAdmin() === $this) {
                $camping->setAdmin(null);
            }
        }

        return $this;
    }

    public function getUserIdentifier(): string
    {
        // Remplace getUsername() pour identifier l'utilisateur
        return $this->username;
    }

    public function getRoles(): array
    {
        // Ajoute ROLE_USER par défaut
        return array_unique(array_merge($this->roles, ['ROLE_ADMIN']));
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // Méthode pour effacer des données sensibles, comme un mot de passe en clair
    }
}
