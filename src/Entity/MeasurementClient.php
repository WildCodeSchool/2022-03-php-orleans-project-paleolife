<?php

namespace App\Entity;

use App\Repository\MeasurementClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MeasurementClientRepository::class)]
#[UniqueEntity(fields: ['valueBefore', 'valueAfter', 'client'])]
class MeasurementClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Assert\Positive]
    #[ORM\Column(type: 'decimal', precision: 4, scale: 1, nullable: true)]
    private float $valueBefore;

    #[Assert\Positive]
    #[ORM\Column(type: 'decimal', precision: 4, scale: 1, nullable: true)]
    private float $valueAfter;

    #[ORM\ManyToOne(targetEntity: Measurement::class, inversedBy: 'measurementClients')]
    private ?Measurement $measurement;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'measurementClients')]
    private ?Client $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValueBefore(): ?string
    {
        return $this->valueBefore;
    }

    public function setValueBefore(?string $valueBefore): self
    {
        $this->valueBefore = $valueBefore;

        return $this;
    }

    public function getValueAfter(): ?string
    {
        return $this->valueAfter;
    }

    public function setValueAfter(?string $valueAfter): self
    {
        $this->valueAfter = $valueAfter;

        return $this;
    }

    public function getMeasurement(): ?Measurement
    {
        return $this->measurement;
    }

    public function setMeasurement(?Measurement $measurement): self
    {
        $this->measurement = $measurement;

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
