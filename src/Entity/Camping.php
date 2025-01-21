<?php

namespace App\Entity;

use App\Repository\CampingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampingRepository::class)]
class Camping
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\OneToMany(mappedBy: 'camping', targetEntity: Section::class, cascade: ['persist', 'remove'])]
    private Collection $sections;

    #[ORM\OneToMany(targetEntity: UserAccount::class, mappedBy: 'camping')]
    private Collection $userAccounts;

    #[ORM\ManyToOne(targetEntity: Admin::class, inversedBy: 'campings')]
    private ?Admin $admin = null;




    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->userAccounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function __toString(): string
    {
        return $this->name ?? '';
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }




    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSection(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
        }

        return $this;
    }

    public function removesection(Section $section): self
    {
        $this->sections->removeElement($section);

        return $this;
    }

    public function getUserAccounts(): Collection
    {
        return $this->userAccounts;
    }

    public function addUserAccount(UserAccount $userAccount): self
    {
        if (!$this->userAccounts->contains($userAccount)) {
            $this->userAccounts->add($userAccount);
            $userAccount->setCamping($this);
        }

        return $this;
    }

    public function removeUserAccount(UserAccount $userAccount): self
    {
        if ($this->userAccounts->removeElement($userAccount)) {
            if ($userAccount->getCamping() === $this) {
                $userAccount->setCamping(null);
            }
        }

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
}
