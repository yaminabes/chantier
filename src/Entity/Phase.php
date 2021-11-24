<?php

namespace App\Entity;

use App\Repository\PhaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhaseRepository::class)
 */
class Phase
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
    private $nomPhase;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;




    /**
     * @ORM\ManyToMany(targetEntity=Chantier::class, inversedBy="phases")
     */
    private $chantier;

    /**
     * @ORM\ManyToMany(targetEntity=Tache::class, mappedBy="phase")
     */
    private $taches;

    public function __construct()
    {
        $this->chantier = new ArrayCollection();
        $this->taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPhase(): ?string
    {
        return $this->nomPhase;
    }

    public function setNomPhase(string $nomPhase): self
    {
        $this->nomPhase = $nomPhase;

        return $this;
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






    /**
     * @return Collection|Chantier[]
     */
    public function getChantier(): Collection
    {
        return $this->chantier;
    }

    public function addChantier(Chantier $chantier): self
    {
        if (!$this->chantier->contains($chantier)) {
            $this->chantier[] = $chantier;
        }

        return $this;
    }

    public function removeChantier(Chantier $chantier): self
    {
        $this->chantier->removeElement($chantier);

        return $this;
    }

    /**
     * @return Collection|Tache[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
            $tach->addPhase($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            $tach->removePhase($this);
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
        return $this->nomPhase;
    }


}
