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

    #[ORM\ManyToOne(inversedBy: 'ingredient')]
    private ?Unit $unit = null;

    #[ORM\ManyToOne(inversedBy: 'ingredient')]
    private ?Weight $weight = null;

    private ?float $weightValue = null; // Champ temporaire pour le formulaire

    public function __construct()
    {
        $this->datasheet = new ArrayCollection();
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
        return $this->name ?? 'Ingrédient sans nom';
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

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): static
    {
        $this->unit = $unit;
        return $this;
    }

    public function getWeight(): ?Weight
    {
        return $this->weight;
    }

    public function setWeight(?Weight $weight): static
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWeightValue(): ?float
    {
        // Si un poids existe, retourner sa valeur ; sinon retourner la valeur temporaire
        return $this->weight ? $this->weight->getValue() : $this->weightValue;
    }

    public function setWeightValue(?float $weightValue): self
    {
        $this->weightValue = $weightValue;
        return $this;
    }
}
