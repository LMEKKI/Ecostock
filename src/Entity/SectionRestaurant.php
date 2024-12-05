<?php

namespace App\Entity;

use App\Repository\SectionRestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRestaurantRepository::class)]
class SectionRestaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $adresse = null;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'Category')]
    private Collection $categories;

    /**
     * @var Collection<int, Camping>
     */
    #[ORM\ManyToMany(targetEntity: Camping::class, mappedBy: 'Camping')]
    private Collection $camping;

    /**
     * @var Collection<int, UserAccount>
     */
    #[ORM\OneToMany(targetEntity: UserAccount::class, mappedBy: 'SectionRestaurant')]
    private Collection $userAccounts;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->camping = new ArrayCollection();
        $this->userAccounts = new ArrayCollection();
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
            $category->addService($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeService($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Camping>
     */
    public function getCamping(): Collection
    {
        return $this->camping;
    }

    public function addCamping(Camping $camping): static
    {
        if (!$this->camping->contains($camping)) {
            $this->camping->add($camping);
            $camping->addService($this);
        }

        return $this;
    }

    public function removeCamping(Camping $camping): static
    {
        if ($this->camping->removeElement($camping)) {
            $camping->removeService($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, UserAccount>
     */
    public function getUserAccounts(): Collection
    {
        return $this->userAccounts;
    }

    public function addUserAccount(UserAccount $userAccount): static
    {
        if (!$this->userAccounts->contains($userAccount)) {
            $this->userAccounts->add($userAccount);
            $userAccount->setSectionRestaurant($this);
        }

        return $this;
    }

    public function removeUserAccount(UserAccount $userAccount): static
    {
        if ($this->userAccounts->removeElement($userAccount)) {
            // set the owning side to null (unless already changed)
            if ($userAccount->getSectionRestaurant() === $this) {
                $userAccount->setSectionRestaurant(null);
            }
        }

        return $this;
    }
}
