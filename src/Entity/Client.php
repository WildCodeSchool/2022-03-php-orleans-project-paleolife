<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $globalName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $monthName;

    #[ORM\OneToOne(inversedBy: 'client', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private ?User $user;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getClient() !== $this) {
            $user->setClient($this);
        }

        $this->user = $user;

        return $this;
    }
}
