<?php

namespace App\Entity;

use App\Repository\ProposeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposeRepository::class)
 */
class Propose
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Materiaux::class, inversedBy="proposes")
     */
    private $materiaux;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="proposes")
     */
    private $fournisseur;

    /**
     * @ORM\Column(type="float")
     */
    private $cout;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMateriaux(): ?Materiaux
    {
        return $this->materiaux;
    }

    public function setMateriaux(?Materiaux $materiaux): self
    {
        $this->materiaux = $materiaux;

        return $this;
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

    public function getCout(): ?float
    {
        return $this->cout;
    }

    public function setCout(float $cout): self
    {
        $this->cout = $cout;

        return $this;
    }
}
