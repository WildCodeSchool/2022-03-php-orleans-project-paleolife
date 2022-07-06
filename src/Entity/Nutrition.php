<?php

namespace App\Entity;

use App\Repository\NutritionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NutritionRepository::class)]
class Nutrition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $objective;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $energyExpenditure;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $water;

    #[ORM\OneToOne(inversedBy: 'nutrition', targetEntity: Client::class, cascade: ['persist', 'remove'])]
    private ?Client $client;

    #[ORM\OneToMany(mappedBy: 'nutrition', targetEntity: Meal::class)]
    private Collection $meals;

    public function __construct()
    {
        $this->meals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjective(): ?string
    {
        return $this->objective;
    }

    public function setObjective(?string $objective): self
    {
        $this->objective = $objective;

        return $this;
    }

    public function getEnergyExpenditure(): ?int
    {
        return $this->energyExpenditure;
    }

    public function setEnergyExpenditure(?int $energyExpenditure): self
    {
        $this->energyExpenditure = $energyExpenditure;

        return $this;
    }

    public function getWater(): ?int
    {
        return $this->water;
    }

    public function setWater(?int $water): self
    {
        $this->water = $water;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Meal>
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    public function addMeal(Meal $meal): self
    {
        if (!$this->meals->contains($meal)) {
            $this->meals[] = $meal;
            $meal->setNutrition($this);
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        if ($this->meals->removeElement($meal)) {
            // set the owning side to null (unless already changed)
            if ($meal->getNutrition() === $this) {
                $meal->setNutrition(null);
            }
        }

        return $this;
    }
}
