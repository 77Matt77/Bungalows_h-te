<?php

namespace App\Entity;

use App\Repository\CalendrierRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendrierRepository::class)]
class Calendrier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDisponible = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDisponible(): ?\DateTimeInterface
    {
        return $this->dateDisponible;
    }

    public function setDateDisponible(\DateTimeInterface $dateDisponible): static
    {
        $this->dateDisponible = $dateDisponible;

        return $this;
    }
}
