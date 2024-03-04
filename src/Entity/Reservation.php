<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "date_arriver", type: "datetime")]
    private ?\DateTimeInterface $dateArriver = null;

    #[ORM\Column(name: "date_depart", type: "datetime")]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\Column(name: "nombre_de_personne")]
    private ?int $numberOfPeople = null;

    #[ORM\ManyToOne(targetEntity: Commande::class)]
    #[ORM\JoinColumn(name: "commande_id", referencedColumnName: "id")]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(targetEntity: Formule::class)]
    #[ORM\JoinColumn(name: "formule_id", referencedColumnName: "id")]
    private ?Formule $formule = null;

    #[ORM\ManyToOne(targetEntity: Option::class)]
    #[ORM\JoinColumn(name: "option_reservation_id", referencedColumnName: "id")]
    private ?Option $optionReservation = null;

    /**
     * @ORM\ManyToOne(targetEntity="Bungalow", inversedBy="reservations")
     * @ORM\JoinColumn(name="bungalow_id", referencedColumnName="id")
     */
    private ?Bungalow $bungalow = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateArriver(): ?\DateTimeInterface
    {
        return $this->dateArriver;
    }

    public function setDateArriver(\DateTimeInterface $dateArriver): static
    {
        $this->dateArriver = $dateArriver;

        return $this;
    }

    public function getNumberOfPeople(): ?int
    {
        return $this->numberOfPeople;
    }

    public function setNumberOfPeople(int $numberOfPeople): static
    {
        $this->numberOfPeople = $numberOfPeople;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

    public function getFormule(): ?Formule
    {
        return $this->formule;
    }

    public function setFormule(?Formule $formule): static
    {
        $this->formule = $formule;

        return $this;
    }

    public function getOptionReservation(): ?Option
    {
        return $this->optionReservation;
    }

    public function setOptionReservation(?Option $optionReservation): static
    {
        $this->optionReservation = $optionReservation;

        return $this;
    }

    public function getBungalow(): ?Bungalow
    {
        return $this->bungalow;
    }

    public function setBungalow(?Bungalow $bungalow): static
    {
        $this->bungalow = $bungalow;

        return $this;
    }
}
