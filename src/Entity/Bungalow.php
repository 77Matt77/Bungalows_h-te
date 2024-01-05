<?php

namespace App\Entity;

use App\Repository\BungalowRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BungalowRepository::class)]
class Bungalow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $capaciter = null;

    #[ORM\Column]
    private ?float $prixParNuit = null;

    #[ORM\ManyToOne(inversedBy: 'Bungalow')]
    private ?Reservation $reservation = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $Image = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Calendrier $Calendrier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCapaciter(): ?int
    {
        return $this->capaciter;
    }

    public function setCapaciter(int $capaciter): static
    {
        $this->capaciter = $capaciter;

        return $this;
    }

    public function getPrixParNuit(): ?float
    {
        return $this->prixParNuit;
    }

    public function setPrixParNuit(float $prixParNuit): static
    {
        $this->prixParNuit = $prixParNuit;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->Image;
    }

    public function setImage(?Image $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getCalendrier(): ?Calendrier
    {
        return $this->Calendrier;
    }

    public function setCalendrier(?Calendrier $Calendrier): static
    {
        $this->Calendrier = $Calendrier;

        return $this;
    }
}
