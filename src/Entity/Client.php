<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Assert\Length(
        max: 100,
    )]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photoBefore;

    #[ORM\OneToOne(inversedBy: 'client', targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoBefore(): ?string
    {
        return $this->photoBefore;
    }

    public function setPhotoBefore(?string $photoBefore): self
    {
        $this->photoBefore = $photoBefore;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
