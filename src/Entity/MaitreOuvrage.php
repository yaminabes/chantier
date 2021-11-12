<?php

namespace App\Entity;

use App\Repository\MaitreOuvrageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaitreOuvrageRepository::class)
 */
class MaitreOuvrage
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
    private $numeroClient;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="maitreOuvrage")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity=Chantier::class, mappedBy="maitre_ouvrage")
     */
    private $chantiers;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->chantiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroClient(): ?string
    {
        return $this->numeroClient;
    }

    public function setNumeroClient(string $numeroClient): self
    {
        $this->numeroClient = $numeroClient;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setMaitreOuvrage($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getMaitreOuvrage() === $this) {
                $user->setMaitreOuvrage(null);
            }
        }

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Chantier[]
     */
    public function getChantiers(): Collection
    {
        return $this->chantiers;
    }

    public function addChantier(Chantier $chantier): self
    {
        if (!$this->chantiers->contains($chantier)) {
            $this->chantiers[] = $chantier;
            $chantier->setMaitreOuvrage($this);
        }

        return $this;
    }

    public function removeChantier(Chantier $chantier): self
    {
        if ($this->chantiers->removeElement($chantier)) {
            // set the owning side to null (unless already changed)
            if ($chantier->getMaitreOuvrage() === $this) {
                $chantier->setMaitreOuvrage(null);
            }
        }

        return $this;
    }
}
