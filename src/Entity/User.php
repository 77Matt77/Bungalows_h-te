<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'cette email existe déja')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message:"Le Prénom est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'le prénom ne doit pas dépasser {{ limit }} charactères.',
    )]
    #[Assert\Regex(
        pattern: '/^[0-9a-zA-Z-\'_ áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+$/i',
        match: true,
        message: 'Le Prénom ne doit contenir ûniquement des lettres, des chiffres le tiret du milieu de l\'underscore',
    )]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[Assert\NotBlank(message:"Le Nom est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'le Nom ne doit pas dépasser {{ limit }} charactères.',
    )]
    #[Assert\Regex(
        pattern: '/^[0-9a-zA-Z-\'_ áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+$/i',
        match: true,
        message: 'Le Nom ne doit contenir ûniquement des lettres, des chiffres le tiret du milieu de l\'underscore',
    )]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[Assert\NotBlank(message:"Le email est obligatoire")]
    #[Assert\Length(
        max: 180,
        maxMessage: 'l\'email ne doit pas dépasser {{ limit }} charactères.',
    )]
    #[Assert\Email(
        message: 'l\'email {{ value }} est invalide.',
    )]    
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Assert\NotBlank(message:"Le mot de passe est obligatoire")]
    #[Assert\Length(
        min: 12,
        max: 255,
        minMessage: 'le mot de passe doit contenir au moins {{ limit }} charactères.',
        maxMessage: 'le mot de passe ne doit pas dépasser {{ limit }} charactères.',
    )]
    #[Assert\Regex(
        pattern: "/^(?=.*[a-zà-ÿ])(?=.*[A-ZÀ-Ỳ])(?=.*[0-9])(?=.*[^a-zà-ÿA-ZÀ-Ỳ0-9]).{11,255}$/",
        match: true,
        message: 'Le Nom ne doit contenir ûniquement des lettres, des chiffres le tiret du milieu de l\'underscore',
    )]

    #[Assert\NotCompromisedPassword(message:"Votre mot de passe est facilement piratable, Veuillez changer votre mot de passe")]
    #[ORM\Column]
    private ?string $password = null;

    #[Gedmo\Timestampable(on: 'create')]    
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $verifiedAt = null;

    #[Gedmo\Timestampable(on: 'update')]     
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Commande::class)]
    private Collection $Commande;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function __construct()
    {
        $this->roles[] = 'ROLE_USER';
        // $this->Commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }   

    public function getVerifiedAt(): ?\DateTimeImmutable
    {
        return $this->verifiedAt;
    }

    public function setVerifiedAt(?\DateTimeImmutable $verifiedAt): static
    {
        $this->verifiedAt = $verifiedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->Commande;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->Commande->contains($commande)) {
            $this->Commande->add($commande);
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->Commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
