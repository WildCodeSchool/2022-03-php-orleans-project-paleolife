<?php

namespace App\Entity;

use App\Repository\NutritionMealRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NutritionMealRepository::class)]
class NutritionMeal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $mealName;

    #[Assert\Positive]
    #[Assert\Type(type: 'integer')]
    #[ORM\Column(type: 'integer', nullable: true)]
    private int $proteins;

    #[Assert\Positive]
    #[Assert\Type(type: 'integer')]
    #[ORM\Column(type: 'integer', nullable: true)]
    private int $lipids;

    #[Assert\Positive]
    #[Assert\Type(type: 'integer')]
    #[ORM\Column(type: 'integer', nullable: true)]
    private int $carbohydrate;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'nutritionMeals')]
    private ?Client $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMealName(): ?string
    {
        return $this->mealName;
    }

    public function setMealName(?string $mealName): self
    {
        $this->mealName = $mealName;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
