<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[Vich\Uploadable] 
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Vich\UploadableField(mapping: 'client_image', fileNameProperty: 'photoBefore')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['photoBefore/jpeg', 'photoBefore/png', 'photoBefore/webp', 'photoBefore/jpg'],
    )]
    private ?File $beforeFile = null;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photoBefore;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'client', targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[Vich\UploadableField(mapping: 'client_image', fileNameProperty: 'photoAfter')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['photoBefore/jpeg', 'photoBefore/png', 'photoBefore/webp', 'photoBefore/jpg'],
    )]
    private ?File $afterFile = null;

    #[Assert\Length(
        max: 255,
    )]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photoAfter;

    #[ORM\Column(type: 'string', length: 255)]
    private string $globalName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $monthName;

    public function __construct()
    {
        $this->updatedAt = new \DateTimeImmutable();
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

    public function setGlobalName(string $globalName): self
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

    public function setMonthName(string $monthName): self
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
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getBeforeFile(): ?File
    {
        return $this->beforeFile;
    }

    public function setAfterFile(?File $afterFile = null): void
    {
        $this->beforeFile = $afterFile;

        if (null !== $afterFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getAfterFile(): ?File
    {
        return $this->afterFile;
    }
}
