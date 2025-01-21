<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;



    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'categories')]
    private Collection $categories;





    #[ORM\ManyToOne(targetEntity: Camping::class, inversedBy: 'sections', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)] // Si la relation est obligatoire
    private ?Camping $camping = null;



    /**
     * @var Collection<int, UserAccount>
     */
    #[ORM\OneToMany(targetEntity: UserAccount::class, mappedBy: 'SectionRestaurant')]
    private Collection $userAccounts;

    /**
     * @var Collection<int, Type>
     */
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'section', cascade: ['persist'])]
    #[ORM\JoinTable(name: 'section_restaurant_type')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]

    private Collection $type;

    public function __toString(): string
    {
        return $this->name ?? 'Section Restaurant';
    }

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->userAccounts = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

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
            $category->addSection($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeSection($this);
        }

        return $this;
    }


    public function getCamping(): ?Camping
    {
        return $this->camping;
    }

    public function setCamping(?Camping $camping): self
    {
        $this->camping = $camping;

        return $this;
    }



    /**
     * @return Collection<int, Type>
     */
    public function getType(): Collection
    {
        return $this->type;
    }
    public function addType(Type $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type->add($type);
            $type->addSection($this); // Ajout de la relation inverse
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->type->removeElement($type)) {
            $type->removeSection($this); // Suppression de la relation inverse
        }

        return $this;
    }
}
