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
     * @ORM\ManyToOne(targetEntity=Tache::class, inversedBy="taches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StatutTache;

    /**
     * @ORM\OneToMany(targetEntity=Tache::class, mappedBy="StatutTache", orphanRemoval=true)
     */
    private $taches;

    /**
     * @ORM\OneToMany(targetEntity=MateriauxNecessaire::class, mappedBy="Tache")
     */
    private $materiauxNecessaires;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
        $this->materiauxNecessaires = new ArrayCollection();
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

    public function getStatutTache(): ?self
    {
        return $this->StatutTache;
    }

    public function setStatutTache(?self $StatutTache): self
    {
        $this->StatutTache = $StatutTache;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(self $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
            $tach->setStatutTache($this);
        }

        return $this;
    }

    public function removeTach(self $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getStatutTache() === $this) {
                $tach->setStatutTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MateriauxNecessaire[]
     */
    public function getMateriauxNecessaires(): Collection
    {
        return $this->materiauxNecessaires;
    }

    public function addMateriauxNecessaire(MateriauxNecessaire $materiauxNecessaire): self
    {
        if (!$this->materiauxNecessaires->contains($materiauxNecessaire)) {
            $this->materiauxNecessaires[] = $materiauxNecessaire;
            $materiauxNecessaire->setTache($this);
        }

        return $this;
    }

    public function removeMateriauxNecessaire(MateriauxNecessaire $materiauxNecessaire): self
    {
        if ($this->materiauxNecessaires->removeElement($materiauxNecessaire)) {
            // set the owning side to null (unless already changed)
            if ($materiauxNecessaire->getTache() === $this) {
                $materiauxNecessaire->setTache(null);
            }
        }

        return $this;
    }
}
