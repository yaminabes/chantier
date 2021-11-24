<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
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
    private $nom_fournisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siret;

    /**
     * @ORM\ManyToMany(targetEntity=Materiaux::class, inversedBy="fournisseurs")
     */
    private $materiaux;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="fournisseur")
     */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity=Propose::class, mappedBy="fournisseur")
     */
    private $proposes;

    public function __construct()
    {
        $this->materiaux = new ArrayCollection();
        $this->factures = new ArrayCollection();
        $this->proposes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFournisseur(): ?string
    {
        return $this->nom_fournisseur;
    }

    public function setNomFournisseur(string $nom_fournisseur): self
    {
        $this->nom_fournisseur = $nom_fournisseur;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return Collection|Materiaux[]
     */
    public function getMateriaux(): Collection
    {
        return $this->materiaux;
    }

    public function addMateriaux(Materiaux $materiaux): self
    {
        if (!$this->materiaux->contains($materiaux)) {
            $this->materiaux[] = $materiaux;
        }

        return $this;
    }

    public function removeMateriaux(Materiaux $materiaux): self
    {
        $this->materiaux->removeElement($materiaux);

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
            $facture->setFournisseur($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getFournisseur() === $this) {
                $facture->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Propose[]
     */
    public function getProposes(): Collection
    {
        return $this->proposes;
    }

    public function addPropose(Propose $propose): self
    {
        if (!$this->proposes->contains($propose)) {
            $this->proposes[] = $propose;
            $propose->setFournisseur($this);
        }

        return $this;
    }

    public function removePropose(Propose $propose): self
    {
        if ($this->proposes->removeElement($propose)) {
            // set the owning side to null (unless already changed)
            if ($propose->getFournisseur() === $this) {
                $propose->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        return $this->getNomFournisseur();
    }

}
