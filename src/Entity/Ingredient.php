<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, DataSheet>
     */
    #[ORM\ManyToMany(targetEntity: DataSheet::class, inversedBy: 'ingredients')]
    private Collection $datasheet;

    /**
     * @var Collection<int, Unit>
     */
    #[ORM\ManyToMany(targetEntity: Unit::class, inversedBy: 'ingredients')]
    private Collection $unit;

    /**
     * @var Collection<int, Weight>
     */
    #[ORM\ManyToMany(targetEntity: Weight::class, inversedBy: 'datasheet')]
    private Collection $weight;

    public function __construct()
    {
        $this->datasheet = new ArrayCollection();
        $this->unit = new ArrayCollection();
        $this->weight = new ArrayCollection();
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

    /**
     * @return Collection<int, DataSheet>
     */
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

    /**
     * @return Collection<int, Unit>
     */
    public function getUnit(): Collection
    {
        return $this->unit;
    }

    public function addUnit(Unit $unit): static
    {
        if (!$this->unit->contains($unit)) {
            $this->unit->add($unit);
        }

        return $this;
    }

    public function removeUnit(Unit $unit): static
    {
        $this->unit->removeElement($unit);

        return $this;
    }

    /**
     * @return Collection<int, Weight>
     */
    public function getWeight(): Collection
    {
        return $this->weight;
    }

    public function addWeight(Weight $weight): static
    {
        if (!$this->weight->contains($weight)) {
            $this->weight->add($weight);
        }

        return $this;
    }

    public function removeWeight(Weight $weight): static
    {
        $this->weight->removeElement($weight);

        return $this;
    }
}
