<?php

namespace App\Entity;

use App\Repository\ChantierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChantierRepository::class)
 */
class Chantier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity=Phase::class, mappedBy="chantier")
     */
    private $phases;

    /**
     * @ORM\ManyToOne(targetEntity=ConducteurTravaux::class, inversedBy="chantiers")
     */
    private $conducteur_travaux;

    /**
     * @ORM\ManyToOne(targetEntity=MaitreOuvrage::class, inversedBy="chantiers")
     */
    private $maitre_ouvrage;

    /**
     * @ORM\ManyToOne(targetEntity=TypeBatiment::class, inversedBy="chantiers")
     */
    private $type_batiment;


    public function __construct()
    {
        $this->phases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Phase[]
     */
    public function getPhases(): Collection
    {
        return $this->phases;
    }

    public function addPhase(Phase $phase): self
    {
        if (!$this->phases->contains($phase)) {
            $this->phases[] = $phase;
            $phase->addChantier($this);
        }

        return $this;
    }

    public function removePhase(Phase $phase): self
    {
        if ($this->phases->removeElement($phase)) {
            $phase->removeChantier($this);
        }

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

    public function getMaitreOuvrage(): ?MaitreOuvrage
    {
        return $this->maitre_ouvrage;
    }

    public function setMaitreOuvrage(?MaitreOuvrage $maitre_ouvrage): self
    {
        $this->maitre_ouvrage = $maitre_ouvrage;

        return $this;
    }

    public function getTypeBatiment(): ?TypeBatiment
    {
        return $this->type_batiment;
    }

    public function setTypeBatiment(?TypeBatiment $type_batiment): self
    {
        $this->type_batiment = $type_batiment;

        return $this;
    }


}
