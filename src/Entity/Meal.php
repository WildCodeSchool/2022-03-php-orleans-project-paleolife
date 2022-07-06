<?php

namespace App\Entity;

use App\Repository\MealRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealRepository::class)]
class Meal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $proteins;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $lipids;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $carbohydrate;

    #[ORM\ManyToOne(targetEntity: Nutrition::class, inversedBy: 'meals')]
    private ?Nutrition $nutrition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProteins(): ?int
    {
        return $this->proteins;
    }

    public function setProteins(?int $proteins): self
    {
        $this->proteins = $proteins;

        return $this;
    }

    public function getLipids(): ?int
    {
        return $this->lipids;
    }

    public function setLipids(?int $lipids): self
    {
        $this->lipids = $lipids;

        return $this;
    }

    public function getCarbohydrate(): ?int
    {
        return $this->carbohydrate;
    }

    public function setCarbohydrate(?int $carbohydrate): self
    {
        $this->carbohydrate = $carbohydrate;

        return $this;
    }

    public function getNutrition(): ?Nutrition
    {
        return $this->nutrition;
    }

    public function setNutrition(?Nutrition $nutrition): self
    {
        $this->nutrition = $nutrition;

        return $this;
    }
}
