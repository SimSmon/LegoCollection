<?php

namespace App\Entity;

use App\Repository\LegoThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LegoThemeRepository::class)]
class LegoTheme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $parent_id = null;

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: Lego::class)]
    private Collection $legos;

    public function __construct()
    {
        $this->legos = new ArrayCollection();
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

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function setParentId(?int $parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * @return Collection<int, Lego>
     */
    public function getLegos(): Collection
    {
        return $this->legos;
    }

    public function addLego(Lego $lego): self
    {
        if (!$this->legos->contains($lego)) {
            $this->legos->add($lego);
            $lego->setTheme($this);
        }

        return $this;
    }

    public function removeLego(Lego $lego): self
    {
        if ($this->legos->removeElement($lego)) {
            // set the owning side to null (unless already changed)
            if ($lego->getTheme() === $this) {
                $lego->setTheme(null);
            }
        }

        return $this;
    }
}
