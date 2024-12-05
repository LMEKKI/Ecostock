<?php

namespace App\Entity;

use App\Repository\CampingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::TEXT)]
    private ?string $adresse = null;

    /**
     * @var Collection<int, SectionRestaurant>
     */
    #[ORM\ManyToMany(targetEntity: SectionRestaurant::class, inversedBy: 'camping')]
    private Collection $SectionRestaurant;


    #[ORM\ManyToOne(inversedBy: 'camping')]
    private ?Admin $admin = null;

    public function __construct()
    {
        $this->SectionRestaurant = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, SectionRestaurant>
     */
    public function getSectionRestaurant(): Collection
    {
        return $this->SectionRestaurant;
    }

    public function addService(SectionRestaurant $sectionRestaurant): static
    {
        if (!$this->SectionRestaurant->contains($sectionRestaurant)) {
            $this->SectionRestaurant->add($sectionRestaurant);
        }

        return $this;
    }

    public function removeService(SectionRestaurant $sectionRestaurant): static
    {
        $this->SectionRestaurant->removeElement($sectionRestaurant);

        return $this;
    }



    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): static
    {
        $this->admin = $admin;

        return $this;
    }
}
