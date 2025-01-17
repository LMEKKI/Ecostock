<?php

namespace App\Entity;

use App\Repository\WeightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeightRepository::class)]
class Weight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $weight = null;

    /**
     * @var Collection<int, Ingredient>
     */
    #[ORM\ManyToMany(targetEntity: Ingredient::class, mappedBy: 'weight')]
    private Collection $datasheet;

    public function __construct()
    {
        $this->datasheet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getDatasheet(): Collection
    {
        return $this->datasheet;
    }

    public function addDatasheet(Ingredient $datasheet): static
    {
        if (!$this->datasheet->contains($datasheet)) {
            $this->datasheet->add($datasheet);
            $datasheet->addWeight($this);
        }

        return $this;
    }

    public function removeDatasheet(Ingredient $datasheet): static
    {
        if ($this->datasheet->removeElement($datasheet)) {
            $datasheet->removeWeight($this);
        }

        return $this;
    }
}
