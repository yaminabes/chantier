<?php

namespace App\Entity;

use App\Repository\StockTacheUtiliseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockTacheUtiliseRepository::class)
 */
class StockTacheUtilise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Stock::class, inversedBy="stockTacheUtilises")
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Tache::class, inversedBy="stockTacheUtilises")
     */
    private $tache;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

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
}
