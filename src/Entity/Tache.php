<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 */
class Tache
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
    private $nom_tache;

    /**
     * @ORM\Column(type="float")
     */
    private $tarif_prestation;



    /**
     * @ORM\OneToMany(targetEntity=MateriauxNecessaires::class, mappedBy="tache")
     */
    private $materiauxNecessaires;

    /**
     * @ORM\ManyToOne(targetEntity=Prestataire::class, inversedBy="taches")
     */
    private $prestataire;

    /**
     * @ORM\ManyToOne(targetEntity=Metier::class, inversedBy="taches")
     */
    private $metier;

    /**
     * @ORM\OneToMany(targetEntity=StockTacheUtilise::class, mappedBy="tache")
     */
    private $stockTacheUtilises;

    /**
     * @ORM\ManyToMany(targetEntity=Phase::class, inversedBy="taches")
     */
    private $phase;

    /**
     * @ORM\ManyToOne(targetEntity=Statut::class, inversedBy="taches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statut;



    public function __construct()
    {
        $this->taches = new ArrayCollection();
        $this->materiauxNecessaires = new ArrayCollection();
        $this->stockTacheUtilises = new ArrayCollection();
        $this->phase = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTache(): ?string
    {
        return $this->nom_tache;
    }

    public function setNomTache(string $nom_tache): self
    {
        $this->nom_tache = $nom_tache;

        return $this;
    }

    public function getTarifPrestation(): ?float
    {
        return $this->tarif_prestation;
    }

    public function setTarifPrestation(float $tarif_prestation): self
    {
        $this->tarif_prestation = $tarif_prestation;

        return $this;
    }

    



    /**
     * @return Collection|MateriauxNecessaires[]
     */
    public function getMateriauxNecessaires(): Collection
    {
        return $this->materiauxNecessaires;
    }

    public function addMateriauxNecessaire(MateriauxNecessaires $materiauxNecessaire): self
    {
        if (!$this->materiauxNecessaires->contains($materiauxNecessaire)) {
            $this->materiauxNecessaires[] = $materiauxNecessaire;
            $materiauxNecessaire->setTache($this);
        }

        return $this;
    }

    public function removeMateriauxNecessaire(MateriauxNecessaires $materiauxNecessaire): self
    {
        if ($this->materiauxNecessaires->removeElement($materiauxNecessaire)) {
            // set the owning side to null (unless already changed)
            if ($materiauxNecessaire->getTache() === $this) {
                $materiauxNecessaire->setTache(null);
            }
        }

        return $this;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    public function getMetier(): ?Metier
    {
        return $this->metier;
    }

    public function setMetier(?Metier $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    /**
     * @return Collection|StockTacheUtilise[]
     */
    public function getStockTacheUtilises(): Collection
    {
        return $this->stockTacheUtilises;
    }

    public function addStockTacheUtilise(StockTacheUtilise $stockTacheUtilise): self
    {
        if (!$this->stockTacheUtilises->contains($stockTacheUtilise)) {
            $this->stockTacheUtilises[] = $stockTacheUtilise;
            $stockTacheUtilise->setTache($this);
        }

        return $this;
    }

    public function removeStockTacheUtilise(StockTacheUtilise $stockTacheUtilise): self
    {
        if ($this->stockTacheUtilises->removeElement($stockTacheUtilise)) {
            // set the owning side to null (unless already changed)
            if ($stockTacheUtilise->getTache() === $this) {
                $stockTacheUtilise->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Phase[]
     */
    public function getPhase(): Collection
    {
        return $this->phase;
    }

    public function addPhase(Phase $phase): self
    {
        if (!$this->phase->contains($phase)) {
            $this->phase[] = $phase;
        }

        return $this;
    }

    public function removePhase(Phase $phase): self
    {
        $this->phase->removeElement($phase);

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

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
        return $this->getNomTache(). " par ".$this->getPrestataire();
    }


}
