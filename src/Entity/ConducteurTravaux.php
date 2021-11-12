<?php

namespace App\Entity;

use App\Repository\ConducteurTravauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConducteurTravauxRepository::class)
 */
class ConducteurTravaux
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
    private $numeroMatricule;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="conducteurTraveaux")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="conducteur_travaux")
     */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity=Chantier::class, mappedBy="conducteur_travaux")
     */
    private $chantiers;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->factures = new ArrayCollection();
        $this->chantiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroMatricule(): ?string
    {
        return $this->numeroMatricule;
    }

    public function setNumeroMatricule(string $numeroMatricule): self
    {
        $this->numeroMatricule = $numeroMatricule;

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
            $user->setConducteurTraveaux($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getConducteurTraveaux() === $this) {
                $user->setConducteurTraveaux(null);
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
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setConducteurTravaux($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getConducteurTravaux() === $this) {
                $facture->setConducteurTravaux(null);
            }
        }

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
            $chantier->setConducteurTravaux($this);
        }

        return $this;
    }

    public function removeChantier(Chantier $chantier): self
    {
        if ($this->chantiers->removeElement($chantier)) {
            // set the owning side to null (unless already changed)
            if ($chantier->getConducteurTravaux() === $this) {
                $chantier->setConducteurTravaux(null);
            }
        }

        return $this;
    }
}
