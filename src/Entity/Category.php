<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?DataSheet $datasheets = null;

    /**
     * @var Collection<int, SectionRestaurant>
     */
    #[ORM\ManyToMany(targetEntity: Section::class, inversedBy: 'categories')]
    private Collection $sections;


    /**
     * @var Collection<int, Type>
     */
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'categories')]
    private Collection $type;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->type = new ArrayCollection();
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



    public function getDatasheets(): ?DataSheet
    {
        return $this->datasheets;
    }

    public function setDatasheets(?DataSheet $datasheets): static
    {
        $this->datasheets = $datasheets;

        return $this;
    }


    /**
     * @return Collection<int, SectionRestaurant>
     */
    public function getSection(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): static
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        $this->sections->removeElement($section);

        return $this;
    }


    /**
     * @return Collection<int, Type>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name ?? 'Categorie sans nom';
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
