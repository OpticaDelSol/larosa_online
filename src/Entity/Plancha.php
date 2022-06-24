<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Plancha
 *
 * @ORM\Table(name="plancha")
 * @ORM\Entity
 */
class Plancha
{
    /**
     * @var int
     *
     * @ORM\Column(name="idplancha", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplancha;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codigo", type="string", length=45, nullable=true)
     */
    private $codigo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ProductoProduccion", mappedBy="planchaIdplancha")
     */
    private $productoProduccionIdproductoProd;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productoProduccionIdproductoProd = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdplancha(): ?int
    {
        return $this->idplancha;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return Collection<int, ProductoProduccion>
     */
    public function getProductoProduccionIdproductoProd(): Collection
    {
        return $this->productoProduccionIdproductoProd;
    }

    public function addProductoProduccionIdproductoProd(ProductoProduccion $productoProduccionIdproductoProd): self
    {
        if (!$this->productoProduccionIdproductoProd->contains($productoProduccionIdproductoProd)) {
            $this->productoProduccionIdproductoProd[] = $productoProduccionIdproductoProd;
            $productoProduccionIdproductoProd->addPlanchaIdplancha($this);
        }

        return $this;
    }

    public function removeProductoProduccionIdproductoProd(ProductoProduccion $productoProduccionIdproductoProd): self
    {
        if ($this->productoProduccionIdproductoProd->removeElement($productoProduccionIdproductoProd)) {
            $productoProduccionIdproductoProd->removePlanchaIdplancha($this);
        }

        return $this;
    }

}
