<?php

namespace App\Entity;

use App\Repository\StatutTacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatutTacheRepository::class)
 */
class StatutTache
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
    private $nom_statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStatut(): ?string
    {
        return $this->nom_statut;
    }

    public function setNomStatut(string $nom_statut): self
    {
        $this->nom_statut = $nom_statut;

        return $this;
    }
}
