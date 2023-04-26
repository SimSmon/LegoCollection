<?php

namespace App\Entity;

use App\Repository\LegoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LegoRepository::class)]
class Lego
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'legos')]
    private Collection $user;

    #[ORM\Column(nullable: true)]
    private ?int $year = null;

    #[ORM\Column(nullable: true)]
    private ?int $num_parts = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageURL = null;

    #[ORM\ManyToOne(inversedBy: 'legos')]
    private ?LegoTheme $theme = null;

    public function __construct()
    {
        $this->user = new ArrayCollection();
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

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getNumParts(): ?int
    {
        return $this->num_parts;
    }

    public function setNumParts(?int $num_parts): self
    {
        $this->num_parts = $num_parts;

        return $this;
    }

    public function getImageURL(): ?string
    {
        return $this->imageURL;
    }

    public function setImageURL(?string $imageURL): self
    {
        $this->imageURL = $imageURL;

        return $this;
    }

    public function getTheme(): ?LegoTheme
    {
        return $this->theme;
    }

    public function setTheme(?LegoTheme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
