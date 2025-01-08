<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   
    #[ORM\Column(type: Types::JSON)]
    #[Assert\NotBlank(message: 'La rubrique de la catégorie est obligatoire.')]
    private array $rubrique = [];
 
    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?DataSheet $datasheets = null;

   

    /**
     * @var Collection<int, SectionRestaurant>
     */
    #[ORM\ManyToMany(targetEntity: SectionRestaurant::class, inversedBy: 'categories')]
    private Collection $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
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

    public function getRubrique(): array
    {
        return $this->rubrique;
    }

    public function setRubrique(array $rubrique): static
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    public function getDatasheets(): ?Datasheet
    {
        return $this->datasheets;
    }

    public function setDatasheets(?Datasheet $datasheets): static
    {
        $this->datasheets = $datasheets;

        return $this;
    }

    public function __toString(): string
    {
        return !empty($this->rubrique) ? implode(', ', $this->rubrique) : 'Aucune rubrique';
    }
    

    /**
     * @return Collection<int, SectionRestaurant>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(SectionRestaurant $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
        }

        return $this;
    }

    public function removeService(SectionRestaurant $service): static
    {
        $this->services->removeElement($service);

        return $this;
    }
    
}
