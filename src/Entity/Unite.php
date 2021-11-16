<?php

namespace App\Entity;

use App\Repository\UniteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UniteRepository::class)
 */
class Unite
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
    private $nom_unite;

    /**
     * @ORM\OneToMany(targetEntity=Materiaux::class, mappedBy="unite")
     */
    private $materiauxes;

    public function __construct()
    {
        $this->materiauxes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUnite(): ?string
    {
        return $this->nom_unite;
    }

    public function setNomUnite(string $nom_unite): self
    {
        $this->nom_unite = $nom_unite;

        return $this;
    }

    /**
     * @return Collection|Materiaux[]
     */
    public function getMateriauxes(): Collection
    {
        return $this->materiauxes;
    }

    public function addMateriaux(Materiaux $materiaux): self
    {
        if (!$this->materiauxes->contains($materiaux)) {
            $this->materiauxes[] = $materiaux;
            $materiaux->setUnite($this);
        }

        return $this;
    }

    public function removeMateriaux(Materiaux $materiaux): self
    {
        if ($this->materiauxes->removeElement($materiaux)) {
            // set the owning side to null (unless already changed)
            if ($materiaux->getUnite() === $this) {
                $materiaux->setUnite(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom_unite;
    }
}
