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

    #[ORM\Column]
    private ?int $ref = null;

    #[ORM\OneToMany(mappedBy: 'lego', targetEntity: LegoUserRelation::class)]
    private Collection $legoUserRelations;

    public function __construct()
    {
        $this->legoUserRelations = new ArrayCollection();
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

    public function getRef(): ?int
    {
        return $this->ref;
    }

    public function setRef(int $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * @return Collection<int, LegoUserRelation>
     */
    public function getLegoUserRelations(): Collection
    {
        return $this->legoUserRelations;
    }

    public function addLegoUserRelation(LegoUserRelation $legoUserRelation): self
    {
        if (!$this->legoUserRelations->contains($legoUserRelation)) {
            $this->legoUserRelations->add($legoUserRelation);
            $legoUserRelation->setLego($this);
        }

        return $this;
    }

    public function removeLegoUserRelation(LegoUserRelation $legoUserRelation): self
    {
        if ($this->legoUserRelations->removeElement($legoUserRelation)) {
            // set the owning side to null (unless already changed)
            if ($legoUserRelation->getLego() === $this) {
                $legoUserRelation->setLego(null);
            }
        }

        return $this;
    }
}
