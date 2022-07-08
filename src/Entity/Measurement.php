<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MeasurementRepository::class)]
class Measurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    #[ORM\Column(type: 'string', length: 50)]
    private string $unity;

    #[ORM\OneToMany(mappedBy: 'measurement', targetEntity: MeasurementClient::class, cascade:['remove'])]
    private Collection $measurementClients;

    public function __construct()
    {
        $this->measurementClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUnity(): ?string
    {
        return $this->unity;
    }

    public function setUnity(string $unity): self
    {
        $this->unity = $unity;

        return $this;
    }

    /**
     * @return Collection<int, MeasurementClient>
     */
    public function getMeasurementClients(): Collection
    {
        return $this->measurementClients;
    }

    public function addMeasurementClient(MeasurementClient $measurementClient): self
    {
        if (!$this->measurementClients->contains($measurementClient)) {
            $this->measurementClients[] = $measurementClient;
            $measurementClient->setMeasurement($this);
        }

        return $this;
    }

    public function removeMeasurementClient(MeasurementClient $measurementClient): self
    {
        if ($this->measurementClients->removeElement($measurementClient)) {
            // set the owning side to null (unless already changed)
            if ($measurementClient->getMeasurement() === $this) {
                $measurementClient->setMeasurement(null);
            }
        }

        return $this;
    }
}
