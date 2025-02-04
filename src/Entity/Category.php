<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, SectionRestaurant>
     */
    #[ORM\ManyToMany(targetEntity: Section::class, inversedBy: 'category')]
    private Collection $sections;

    /**
     * @var Collection<int, Type>
     */
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'category')]
    private Collection $type;

    /**
     * @var Collection<int, DataSheet>
     */
    #[ORM\ManyToMany(targetEntity: DataSheet::class, mappedBy: 'category')]
    private Collection $datasheet;

    public function __construct()
    {
        $this->datasheet = new ArrayCollection();
        $this->type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDatasheet(): Collection
    {
        return $this->datasheet;
    }

    public function addDatasheet(DataSheet $datasheet): static
    {
        if (!$this->datasheet->contains($datasheet)) {
            $this->datasheet->add($datasheet);
        }
        return $this;
    }

    public function removeDatasheet(DataSheet $datasheet): static
    {
        $this->datasheet->removeElement($datasheet);
        return $this;
    }
    public function __toString(): string
    {
        return $this->name ?? '';
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

    public function addType(Type $type): static
    {
        if (!$this->type->contains($type)) {
            $this->type->add($type);
        }
        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->type->removeElement($type);
        return $this;
    }
}
