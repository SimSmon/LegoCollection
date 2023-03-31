<?php

namespace App\Entity;

use App\Repository\LegoUserRelationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LegoUserRelationRepository::class)]
class LegoUserRelation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'legoUserRelations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lego $lego = null;

    #[ORM\ManyToOne(inversedBy: 'legoUserRelations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLego(): ?Lego
    {
        return $this->lego;
    }

    public function setLego(?Lego $lego): self
    {
        $this->lego = $lego;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
