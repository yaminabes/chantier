<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    public function __toString()
    {
        return $this->fournisseur;
    }
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="factures")
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity=ConducteurTravaux::class, inversedBy="factures")
     */
    private $conducteur_travaux;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="facture")
     */
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getConducteurTravaux(): ?ConducteurTravaux
    {
        return $this->conducteur_travaux;
    }

    public function setConducteurTravaux(?ConducteurTravaux $conducteur_travaux): self
    {
        $this->conducteur_travaux = $conducteur_travaux;

        return $this;
    }



    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setFacture($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getFacture() === $this) {
                $commande->setFacture(null);
            }
        }

        return $this;
    }
}
