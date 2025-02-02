<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Notifier\Message\NullMessage;

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
    #[ORM\ManyToOne(targetEntity: DataSheet::class, inversedBy: 'ingredients')]
    private ?DataSheet $datasheet = null;

    #[ORM\ManyToOne(inversedBy: 'ingredient')]
    private ?Unit $unit = null;

    #[ORM\ManyToOne(inversedBy: 'ingredient', cascade: ['persist'])]
    private ?Weight $weight = null;

    private ?float $weightValue = null; // Champ temporaire pour le formulaire

    public function __construct() {}

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

    public function getDataSheet(): Collection
    {
        return $this->datasheet;
    }

    public function setDataSheet(?DataSheet $datasheet): static
    {
        $this->datasheet = $datasheet;

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

        return $this;
    }

    public function removeWeight(Weight $weight): static
    {
        if ($this->weight === $weight) {
            $this->weight = null;
        }


        return $this;
    }



    public function getWeightValue(): ?float
    {
        return $this->weightValue;
    }

    public function setWeightValue(?float $weightValue): static
    {
        $this->weightValue = $weightValue;

        // Convertir la valeur flottante en une instance de Weight
        if ($weightValue !== null) {
            $weight = new Weight();
            $weight->setValue($weightValue);
            $this->setWeight($weight);
        } else {
            $this->setWeight(null);
        }

        return $this;
    }
}
