<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[Vich\Uploadable]

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Le nom de l'image ne peut pas être vide.")]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;


    #[ORM\ManyToOne(targetEntity: Bungalow::class, inversedBy: 'images')]
    #[ORM\JoinColumn(name: "bungalow_id", referencedColumnName: "id", nullable: false)]
    private ?Bungalow $bungalow = null;

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

    public function getBungalow(): ?Bungalow
    {
        return $this->bungalow;
    }

    public function setBungalow(?Bungalow $bungalow): static
    {
        $this->bungalow = $bungalow;

        return $this;
    }

    /**
 * NOTE: This is not an ORM-mapped field of entity metadata, just a simple property.
 *
 * @Vich\UploadableField(mapping="bungalow_image", fileNameProperty="nom")
 * @var File|null
 */
    #[Vich\UploadableField(mapping: "bungalow_image", fileNameProperty: "nom")]
    private ?File $imageFile = null;
    

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): static
    {
        $this->imageFile = $imageFile;

        return $this;
    }
}
