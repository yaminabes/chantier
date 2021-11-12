<?php

namespace App\Entity;

use App\Repository\MateriauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MateriauxRepository::class)
 */
class Materiaux
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
    private $nom_materiaux;

    /**
     * @ORM\ManyToOne(targetEntity=Unite::class, inversedBy="materiauxes")
     */
    private $unite;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="materiaux")
     */
    private $stocks;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="materiaux")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=Propose::class, mappedBy="materiaux")
     */
    private $proposes;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->proposes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMateriaux(): ?string
    {
        return $this->nom_materiaux;
    }

    public function setNomMateriaux(string $nom_materiaux): self
    {
        $this->nom_materiaux = $nom_materiaux;

        return $this;
    }

    public function getUnite(): ?Unite
    {
        return $this->unite;
    }

    public function setUnite(?Unite $unite): self
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setMateriaux($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getMateriaux() === $this) {
                $stock->setMateriaux(null);
            }
        }

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
            $commande->setMateriaux($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getMateriaux() === $this) {
                $commande->setMateriaux(null);
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
            $propose->setMateriaux($this);
        }

        return $this;
    }

    public function removePropose(Propose $propose): self
    {
        if ($this->proposes->removeElement($propose)) {
            // set the owning side to null (unless already changed)
            if ($propose->getMateriaux() === $this) {
                $propose->setMateriaux(null);
            }
        }

        return $this;
    }
}
