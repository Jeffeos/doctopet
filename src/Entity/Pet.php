<?php

namespace App\Entity;

use App\Repository\PetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PetRepository::class)
 */
class Pet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $happiness;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="pet", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasPills;

    /**
     * @ORM\Column(type="integer")
     */
    private $health;
  
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hasBamboo = 0;

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

    public function getHappiness(): ?int
    {
        return $this->happiness;
    }

    public function setHappiness(int $happiness): self
    {
        $this->happiness = $happiness;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        // set the owning side of the relation if necessary
        if ($user->getPet() !== $this) {
            $user->setPet($this);
        }

        return $this;
    }

    public function getHasPills(): ?bool
    {
        return $this->hasPills;
    }

    public function setHasPills(bool $hasPills): self
    {
        $this->hasPills = $hasPills;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;
      
        return $this;
    }

    public function getHasBamboo(): ?int
    {
        return $this->hasBamboo;
    }

    public function setHasBamboo(?int $hasBamboo): self
    {
        $this->hasBamboo = $hasBamboo;

        return $this;
    }
}
