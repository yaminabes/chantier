<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;

/**
 * @ORM\Entity(repositoryClass=MetierRepository::class)
 */
class Metier
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
    private $corps_metier;

    /**
     * @ORM\ManyToMany(targetEntity=Prestataire::class, inversedBy="metiers")
     */
    private $prestataires;

    /**
     * @ORM\OneToMany(targetEntity=Tache::class, mappedBy="metier")
     */
    private $taches;

    public function __construct()
    {
        $this->prestataires = new ArrayCollection();
        $this->taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCorpsMetier(): ?string
    {
        return $this->corps_metier;
    }

    public function setCorpsMetier(string $corps_metier): self
    {
        $this->corps_metier = $corps_metier;

        return $this;
    }

    /**
     * @return Collection|Prestataire[]
     */
    public function getPrestataires(): Collection
    {
        return $this->prestataires;
    }

    public function addPrestataire(Prestataire $prestataire): self
    {
        if (!$this->prestataires->contains($prestataire)) {
            $this->prestataires[] = $prestataire;
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        $this->prestataires->removeElement($prestataire);

        return $this;
    }

    public function __toString()
    {
        return $this->corps_metier;

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
            $tach->setMetier($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getMetier() === $this) {
                $tach->setMetier(null);
            }
        }

        return $this;
    }


}
