<?php

namespace App\Entity;

use App\Repository\MateriauxNecessairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MateriauxNecessairesRepository::class)
 */
class MateriauxNecessaires
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
    private $quantite_prevue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantite_utilisee;

    /**
     * @ORM\ManyToOne(targetEntity=Materiaux::class, inversedBy="materiauxNecessaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiaux;

    /**
     * @ORM\ManyToOne(targetEntity=Tache::class, inversedBy="materiauxNecessaires")
     */
    private $tache;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantitePrevue(): ?float
    {
        return $this->quantite_prevue;
    }

    public function setQuantitePrevue(float $quantite_prevue): self
    {
        $this->quantite_prevue = $quantite_prevue;

        return $this;
    }

    public function getQuantiteUtilisee(): ?string
    {
        return $this->quantite_utilisee;
    }

    public function setQuantiteUtilisee(string $quantite_utilisee): self
    {
        $this->quantite_utilisee = $quantite_utilisee;

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

    public function getTache(): ?Tache
    {
        return $this->tache;
    }

    public function setTache(?Tache $tache): self
    {
        $this->tache = $tache;

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
       return $this->getMateriaux()." pour ".$this->getTache();
    }

}
