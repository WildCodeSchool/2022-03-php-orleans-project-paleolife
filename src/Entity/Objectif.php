<?php

namespace App\Entity;

use App\Repository\ObjectifRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjectifRepository::class)]
class Objectif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $globalName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $weekName;

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

    public function getWeekName(): ?string
    {
        return $this->weekName;
    }

    public function setWeekName(string $weekName): self
    {
        $this->weekName = $weekName;

        return $this;
    }
}
