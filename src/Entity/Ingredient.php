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

    #[ORM\ManyToOne(inversedBy: 'ingredient', cascade: ['persist'])]
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

    public function getDataSheet(): ?DataSheet
    {
        return $this->dataSheet;
    }

    public function setDataSheet(?DataSheet $dataSheet): static
    {
        $this->dataSheet = $dataSheet;

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

    public function setUnit(?Unit $unit): static
    {
        if (!$this->unit->contains($unit)) {
            $this->unit->add($unit);
        }

        return $this;
    }

    public function getWeight(): ?Weight
    {
        return $this->weight;
    }

    public function setWeight(?Weight $weight): static
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
