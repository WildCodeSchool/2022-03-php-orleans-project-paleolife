<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use DateTimeInterface;
use Serializable;
use Symfony\Component\Validator\Constraints\Cascade;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[Vich\Uploadable]
class Client implements Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Vich\UploadableField(mapping: 'client_image', fileNameProperty: 'photoBefore')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $beforeFile = null;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photoBefore;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'client', targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[Vich\UploadableField(mapping: 'client_image', fileNameProperty: 'photoAfter')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $afterFile = null;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photoAfter;

    #[ORM\Column(type: 'string', length: 255)]
    private string $globalName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $monthName;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $dateBefore;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?DateTimeInterface $dateAfter;

    #[Assert\Valid]
    #[ORM\OneToMany(mappedBy: 'client', targetEntity: MeasurementClient::class, cascade: ['remove', 'persist'])]
    private Collection $measurementClients;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Session::class, cascade: ['remove'])]
    #[ORM\OrderBy(['number' => 'ASC'])]
    private ?Collection $sessions;

    #[Assert\Length(max: 255)]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $objectiveNutrition;

    #[Assert\Positive]
    #[Assert\Type(type: 'integer')]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $energyExpenditure;

    #[Assert\Positive]
    #[ORM\Column(type: 'decimal', precision: 4, scale: 2, nullable: true)]
    private ?float $water;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: NutritionMeal::class, cascade: ['remove'])]
    private Collection $nutritionMeals;

    public function __construct()
    {
        $this->updatedAt = new DateTimeImmutable();
        $this->measurementClients = new ArrayCollection();
        $this->sessions = new ArrayCollection();
        $this->nutritionMeals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPhotoBefore(): ?string
    {
        return $this->photoBefore;
    }

    public function setPhotoBefore(?string $photoBefore): void
    {
        $this->photoBefore = $photoBefore;
    }

    public function getGlobalName(): ?string
    {
        return $this->globalName;
    }

    public function setGlobalName(?string $globalName): self
    {
        $this->globalName = $globalName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getMonthName(): ?string
    {
        return $this->monthName;
    }

    public function setMonthName(?string $monthName): self
    {
        $this->monthName = $monthName;

        return $this;
    }

    public function getPhotoAfter(): ?string
    {
        return $this->photoAfter;
    }

    public function setPhotoAfter(?string $photoAfter): self
    {
        $this->photoAfter = $photoAfter;

        return $this;
    }

    public function setBeforeFile(?File $beforeFile = null): void
    {
        $this->beforeFile = $beforeFile;

        if (null !== $beforeFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    public function getBeforeFile(): ?File
    {
        return $this->beforeFile;
    }

    public function setAfterFile(?File $afterFile = null): void
    {
        $this->afterFile = $afterFile;

        if (null !== $afterFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    public function getAfterFile(): ?File
    {
        return $this->afterFile;
    }

    public function getDateBefore(): ?DateTimeInterface
    {
        return $this->dateBefore;
    }

    public function setDateBefore(?DateTimeInterface $dateBefore): self
    {
        $this->dateBefore = $dateBefore;

        return $this;
    }

    public function getDateAfter(): ?DateTimeInterface
    {
        return $this->dateAfter;
    }

    public function setDateAfter(?DateTimeInterface $dateAfter): self
    {
        $this->dateAfter = $dateAfter;

        return $this;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->photoBefore,
            $this->photoAfter,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list(
            $this->id,
        ) = unserialize($serialized);
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setClient($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getClient() === $this) {
                $session->setClient(null);
            }
        }

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
            $measurementClient->setClient($this);
        }

        return $this;
    }

    public function removeMeasurementClient(MeasurementClient $measurementClient): self
    {
        if ($this->measurementClients->removeElement($measurementClient)) {
            // set the owning side to null (unless already changed)
            if ($measurementClient->getClient() === $this) {
                $measurementClient->setClient(null);
            }
        }

        return $this;
    }

    public function getObjectiveNutrition(): ?string
    {
        return $this->objectiveNutrition;
    }

    public function setObjectiveNutrition(?string $objectiveNutrition): self
    {
        $this->objectiveNutrition = $objectiveNutrition;

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

    public function getWater(): ?float
    {
        return $this->water;
    }

    public function setWater(?float $water): self
    {
        $this->water = $water;

        return $this;
    }

    /**
     * @return Collection<int, NutritionMeal>
     */
    public function getNutritionMeals(): Collection
    {
        return $this->nutritionMeals;
    }

    public function addNutritionMeal(NutritionMeal $nutritionMeal): self
    {
        if (!$this->nutritionMeals->contains($nutritionMeal)) {
            $this->nutritionMeals[] = $nutritionMeal;
            $nutritionMeal->setClient($this);
        }

        return $this;
    }

    public function removeNutritionMeal(NutritionMeal $nutritionMeal): self
    {
        if ($this->nutritionMeals->removeElement($nutritionMeal)) {
            // set the owning side to null (unless already changed)
            if ($nutritionMeal->getClient() === $this) {
                $nutritionMeal->setClient(null);
            }
        }

        return $this;
    }
}
