<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoProduccion
 *
 * @ORM\Table(name="producto_produccion", indexes={@ORM\Index(name="fk_producto_produccion_producto1_idx", columns={"producto_idproducto"})})
 * @ORM\Entity
 */
class ProductoProduccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="idproducto_prod", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproductoProd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nro_placas", type="string", length=45, nullable=true)
     */
    private $nroPlacas;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $fechaCreacion = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     *
     * @ORM\Column(name="costo", type="string", length=45, nullable=true)
     */
    private $costo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="peso_placa", type="string", length=45, nullable=true)
     */
    private $pesoPlaca;

    /**
     * @var \Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="producto_idproducto", referencedColumnName="idproducto")
     * })
     */
    private $productoIdproducto;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Plancha", inversedBy="productoProduccionIdproductoProd")
     * @ORM\JoinTable(name="producto_produccion_has_plancha",
     *   joinColumns={
     *     @ORM\JoinColumn(name="producto_produccion_idproducto_prod", referencedColumnName="idproducto_prod")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="plancha_idplancha", referencedColumnName="idplancha")
     *   }
     * )
     */
    private $planchaIdplancha;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->planchaIdplancha = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdproductoProd(): ?int
    {
        return $this->idproductoProd;
    }

    public function getNroPlacas(): ?string
    {
        return $this->nroPlacas;
    }

    public function setNroPlacas(?string $nroPlacas): self
    {
        $this->nroPlacas = $nroPlacas;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(?\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    public function getCosto(): ?string
    {
        return $this->costo;
    }

    public function setCosto(?string $costo): self
    {
        $this->costo = $costo;

        return $this;
    }

    public function getPesoPlaca(): ?string
    {
        return $this->pesoPlaca;
    }

    public function setPesoPlaca(?string $pesoPlaca): self
    {
        $this->pesoPlaca = $pesoPlaca;

        return $this;
    }

    public function getProductoIdproducto(): ?Producto
    {
        return $this->productoIdproducto;
    }

    public function setProductoIdproducto(?Producto $productoIdproducto): self
    {
        $this->productoIdproducto = $productoIdproducto;

        return $this;
    }

    /**
     * @return Collection<int, Plancha>
     */
    public function getPlanchaIdplancha(): Collection
    {
        return $this->planchaIdplancha;
    }

    public function addPlanchaIdplancha(Plancha $planchaIdplancha): self
    {
        if (!$this->planchaIdplancha->contains($planchaIdplancha)) {
            $this->planchaIdplancha[] = $planchaIdplancha;
        }

        return $this;
    }

    public function removePlanchaIdplancha(Plancha $planchaIdplancha): self
    {
        $this->planchaIdplancha->removeElement($planchaIdplancha);

        return $this;
    }

}
