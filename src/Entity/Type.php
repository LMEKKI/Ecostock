<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;



    public function __toString(): string
    {
        return $this->name ?? 'Non défini';
    }


    /**
     * @var Collection<int, SectionRestaurant>
     */
    #[ORM\ManyToMany(targetEntity: SectionRestaurant::class, inversedBy: 'types')]

    private Collection $sectionRestaurants;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'type')]
    private Collection $categories;

    public function __construct()
    {
        $this->sectionRestaurants = new ArrayCollection();
        $this->categories = new ArrayCollection();
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

    /**
     * @return Collection<int, SectionRestaurant>
     */
    public function getSectionRestaurants(): Collection
    {
        return $this->sectionRestaurants;
    }

    public function addSectionRestaurant(SectionRestaurant $sectionRestaurant): static
    {
        if (!$this->sectionRestaurants->contains($sectionRestaurant)) {
            $this->sectionRestaurants->add($sectionRestaurant);
            $sectionRestaurant->addType($this); // Gestion de la relation inverse
        }

        return $this;
    }

    public function removeSectionRestaurant(SectionRestaurant $sectionRestaurant): static
    {
        if ($this->sectionRestaurants->removeElement($sectionRestaurant)) {
            $sectionRestaurant->removeType($this); // Gestion de la relation inverse
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addType($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeType($this);
        }

        return $this;
    }
}
