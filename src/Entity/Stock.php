<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
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
     * @ORM\ManyToOne(targetEntity=Materiaux::class, inversedBy="stocks")
     */
    private $materiaux;

    /**
     * @ORM\OneToMany(targetEntity=StockTacheUtilise::class, mappedBy="stock")
     */
    private $stockTacheUtilises;

    public function __construct()
    {
        $this->stockTacheUtilises = new ArrayCollection();
    }

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

    /**
     * @return Collection|StockTacheUtilise[]
     */
    public function getStockTacheUtilises(): Collection
    {
        return $this->stockTacheUtilises;
    }

    public function addStockTacheUtilise(StockTacheUtilise $stockTacheUtilise): self
    {
        if (!$this->stockTacheUtilises->contains($stockTacheUtilise)) {
            $this->stockTacheUtilises[] = $stockTacheUtilise;
            $stockTacheUtilise->setStock($this);
        }

        return $this;
    }

    public function removeStockTacheUtilise(StockTacheUtilise $stockTacheUtilise): self
    {
        if ($this->stockTacheUtilises->removeElement($stockTacheUtilise)) {
            // set the owning side to null (unless already changed)
            if ($stockTacheUtilise->getStock() === $this) {
                $stockTacheUtilise->setStock(null);
            }
        }

        return $this;
    }
}
