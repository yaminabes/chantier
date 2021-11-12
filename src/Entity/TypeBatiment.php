<?php

namespace App\Entity;

use App\Repository\TypeBatimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeBatimentRepository::class)
 */
class TypeBatiment
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
    private $nomType;

    /**
     * @ORM\OneToMany(targetEntity=Chantier::class, mappedBy="type_batiment")
     */
    private $chantiers;

    public function __construct()
    {
        $this->chantiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomType(): ?string
    {
        return $this->nomType;
    }

    public function setNomType(string $nomType): self
    {
        $this->nomType = $nomType;

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
            $chantier->setTypeBatiment($this);
        }

        return $this;
    }

    public function removeChantier(Chantier $chantier): self
    {
        if ($this->chantiers->removeElement($chantier)) {
            // set the owning side to null (unless already changed)
            if ($chantier->getTypeBatiment() === $this) {
                $chantier->setTypeBatiment(null);
            }
        }

        return $this;
    }
}
