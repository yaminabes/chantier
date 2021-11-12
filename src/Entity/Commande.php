<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Materiaux::class, inversedBy="commandes")
     */
    private $materiaux;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="commandes")
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
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

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }
}
