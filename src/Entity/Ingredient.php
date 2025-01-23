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

    #[ORM\ManyToOne(inversedBy: 'ingredient')]
    private ?DataSheet $dataSheet = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Unit $unit = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Weight $weight = null;

    
    public function __construct()
    {
   
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

    public function getDataSheet(): ?DataSheet
    {
        return $this->dataSheet;
    }

    public function setDataSheet(?DataSheet $dataSheet): static
    {
        $this->dataSheet = $dataSheet;

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

   
}
