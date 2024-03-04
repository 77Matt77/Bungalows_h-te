<?php

namespace App\Entity;

use App\Repository\BungalowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $name = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(name: "capaciter", type: Types::INTEGER)]
    private ?int $capaciter = null; // Corrected from 'capaciter' to 'capacity'

    #[ORM\Column(name: "price_per_night", type: "float")]
    private ?float $pricePerNight = null;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $activation = null;

      /**
     * @ORM\OneToMany(mappedBy="bungalow", targetEntity="Reservation")
     */
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: "bungalow", targetEntity: Image::class)]
    private Collection $images;

    #[ORM\OneToOne(cascade: ["persist", "remove"])]
    private ?Calendrier $calendrier = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
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

    public function getPricePerNight(): ?float
    {
        return $this->pricePerNight;
    }

    public function setPricePerNight(float $pricePerNight): static
    {
        $this->pricePerNight = $pricePerNight;
        return $this;
    }

    public function getActivation(): ?bool
    {
        return $this->activation;
    }

    public function setActivation(?bool $activation): static
    {
        $this->activation = $activation;
        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setBungalow($this);
        }
        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getBungalow() === $this) {
                $reservation->setBungalow(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setBungalow($this);
        }
        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getBungalow() === $this) {
                $image->setBungalow(null);
            }
        }
        return $this;
    }

    public function getCalendrier(): ?Calendrier
    {
        return $this->calendrier;
    }

    public function setCalendrier(?Calendrier $calendrier): static
    {
        $this->calendrier = $calendrier;
        return $this;
    }
}
