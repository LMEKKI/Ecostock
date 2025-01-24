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
    #[ORM\GeneratedValue(strategy: 'AUTO')]  // Cette option permet à Doctrine de générer automatiquement l'ID
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;


    #[ORM\OneToMany(targetEntity: UserAccount::class, mappedBy: 'camping')]
    private Collection $userAccounts;

    #[ORM\ManyToOne(targetEntity: Admin::class, inversedBy: 'campings')]
    private ?Admin $admin = null;

    /**
     * @var Collection<int, Section>
     */
    #[ORM\OneToMany(targetEntity: Section::class, mappedBy: 'camping')]
    private Collection $section;




    public function __construct()
    {
        $this->userAccounts = new ArrayCollection();
        $this->section = new ArrayCollection();
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

    /**
     * @return Collection<int, Section>
     */
    public function getSection(): Collection
    {
        return $this->section;
    }

    public function addSection(Section $section): static
    {
        if (!$this->section->contains($section)) {
            $this->section->add($section);
            $section->setCamping($this);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        if ($this->section->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getCamping() === $this) {
                $section->setCamping(null);
            }
        }

        return $this;
    }
}
