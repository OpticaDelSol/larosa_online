<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoHasVenta
 *
 * @ORM\Table(name="producto_has_venta", indexes={@ORM\Index(name="fk_producto_has_venta_modelo_color1_idx", columns={"modelo_color_idcolor"}), @ORM\Index(name="fk_producto_has_venta_venta1_idx", columns={"venta_idventa"})})
 * @ORM\Entity
 */
class ProductoHasVenta
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="comision", type="string", length=45, nullable=true)
     */
    private $comision;

    /**
     * @var string|null
     *
     * @ORM\Column(name="precio", type="string", length=45, nullable=true)
     */
    private $precio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="costo", type="string", length=45, nullable=true)
     */
    private $costo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cantidad", type="string", length=45, nullable=true)
     */
    private $cantidad;

    /**
     * @var \Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modelo_color_idcolor", referencedColumnName="idproducto")
     * })
     */
    private $modeloColorIdcolor;

    /**
     * @var \Venta
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Venta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="venta_idventa", referencedColumnName="idventa")
     * })
     */
    private $ventaIdventa;

    public function getComision(): ?string
    {
        return $this->comision;
    }

    public function setComision(?string $comision): self
    {
        $this->comision = $comision;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(?string $precio): self
    {
        $this->precio = $precio;

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

    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(?string $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getModeloColorIdcolor(): ?Producto
    {
        return $this->modeloColorIdcolor;
    }

    public function setModeloColorIdcolor(?Producto $modeloColorIdcolor): self
    {
        $this->modeloColorIdcolor = $modeloColorIdcolor;

        return $this;
    }

    public function getVentaIdventa(): ?Venta
    {
        return $this->ventaIdventa;
    }

    public function setVentaIdventa(?Venta $ventaIdventa): self
    {
        $this->ventaIdventa = $ventaIdventa;

        return $this;
    }


}
