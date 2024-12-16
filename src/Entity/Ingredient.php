<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 75)]
    private ?string $unit = null;

    #[ORM\Column]
    private ?int $weight = null;

    /**
     * @var Collection<int, DataSheet>
     */
    #[ORM\ManyToMany(targetEntity: DataSheet::class, inversedBy: 'ingredients')]
    #[ORM\JoinTable(name: 'datasheet_ingredient')]
    private Collection $Datasheet;

    #[ORM\ManyToOne(inversedBy: 'ingredient')]
    private ?Units $units = null;

    public function __construct()
    {
        $this->Datasheet = new ArrayCollection();
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

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return Collection<int, DataSheet>
     */
    public function getDatasheet(): Collection
    {
        return $this->Datasheet;
    }

    public function addDatasheet(DataSheet $datasheet): static
    {
        if (!$this->Datasheet->contains($datasheet)) {
            $this->Datasheet->add($datasheet);
        }

        return $this;
    }

    public function removeDatasheet(DataSheet $datasheet): static
    {
        $this->Datasheet->removeElement($datasheet);

        return $this;
    }

    public function getUnits(): ?Units
    {
        return $this->units;
    }

    public function setUnits(?Units $units): static
    {
        $this->units = $units;

        return $this;
    }
}
