<?php

namespace App\Entity;

use App\Repository\ObjectiveRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ObjectiveRepository::class)]
class Objective
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        max : 255
    )]
    private string $globalName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        max : 255
    )]
    private string $monthName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGlobalName(): ?string
    {
        return $this->globalName;
    }

    public function setGlobalName(string $globalName): self
    {
        $this->globalName = $globalName;

        return $this;
    }

    public function getMonthName(): ?string
    {
        return $this->monthName;
    }

    public function setMonthName(string $monthName): self
    {
        $this->monthName = $monthName;

        return $this;
    }
}
