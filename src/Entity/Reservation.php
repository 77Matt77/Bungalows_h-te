<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateArrive = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\Column]
    private ?int $nombreDePersonne = null;

    #[ORM\ManyToOne(inversedBy: 'Reservation')]
    private ?Commande $commande = null;

   


    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Bungalow::class)]
    private Collection $Bungalow;

    #[ORM\ManyToMany(targetEntity: Option::class, inversedBy: 'reservations')]
    private Collection $options;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Formule $Formule = null;

    public function __construct()
    {
        
        $this->Bungalow = new ArrayCollection();
        $this->options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->dateArrive;
    }

    public function setDateArrive(\DateTimeInterface $dateArrive): static
    {
        $this->dateArrive = $dateArrive;

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

    public function getNombreDePersonne(): ?int
    {
        return $this->nombreDePersonne;
    }

    public function setNombreDePersonne(int $nombreDePersonne): static
    {
        $this->nombreDePersonne = $nombreDePersonne;

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

    /**
     * @return Collection<int, Bungalow>
     */
    public function getBungalow(): Collection
    {
        return $this->Bungalow;
    }

    public function addBungalow(Bungalow $bungalow): static
    {
        if (!$this->Bungalow->contains($bungalow)) {
            $this->Bungalow->add($bungalow);
            $bungalow->setReservation($this);
        }

        return $this;
    }

    public function removeBungalow(Bungalow $bungalow): static
    {
        if ($this->Bungalow->removeElement($bungalow)) {
            // set the owning side to null (unless already changed)
            if ($bungalow->getReservation() === $this) {
                $bungalow->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Option>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): static
    {
        if (!$this->options->contains($option)) {
            $this->options->add($option);
        }

        return $this;
    }

    public function removeOption(Option $option): static
    {
        $this->options->removeElement($option);

        return $this;
    }

    public function getFormule(): ?Formule
    {
        return $this->Formule;
    }

    public function setFormule(?Formule $Formule): static
    {
        $this->Formule = $Formule;

        return $this;
    }
}
