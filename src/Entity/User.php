<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire au minimum 8 caractères !")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="confirm_password", message="Mot de passe différents")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numTel;

    /**
     * @ORM\ManyToOne(targetEntity=MaitreOuvrage::class, inversedBy="users")
     */
    private $maitreOuvrage;

    /**
     * @ORM\ManyToOne(targetEntity=ConducteurTravaux::class, inversedBy="users")
     */
    private $conducteurTraveaux;

    /**
     * @ORM\ManyToOne(targetEntity=Prestataires::class, inversedBy="users")
     */
    private $prestataire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getMaitreOuvrage(): ?MaitreOuvrage
    {
        return $this->maitreOuvrage;
    }

    public function setMaitreOuvrage(?MaitreOuvrage $maitreOuvrage): self
    {
        $this->maitreOuvrage = $maitreOuvrage;

        return $this;
    }

    public function getConducteurTraveaux(): ?ConducteurTravaux
    {
        return $this->conducteurTraveaux;
    }

    public function setConducteurTraveaux(?ConducteurTravaux $conducteurTraveaux): self
    {
        $this->conducteurTraveaux = $conducteurTraveaux;

        return $this;
    }

    public function getPrestataire(): ?Prestataires
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataires $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }
}
