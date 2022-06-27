<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Venta
 *
 * @ORM\Table(name="venta", indexes={@ORM\Index(name="fk_venta_cliente1_idx", columns={"cliente_idcliente"}), @ORM\Index(name="fk_venta_vendedor1_idx", columns={"vendedor_idvendedor"})})
 * @ORM\Entity
 */
class Venta
{
    /**
     * @var int
     *
     * @ORM\Column(name="idventa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idventa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fecha", type="string", length=45, nullable=true)
     */
    private $fecha;

    /**
     * @var string|null
     *
     * @ORM\Column(name="total", type="string", length=45, nullable=true)
     */
    private $total;

    /**
     * @var string|null
     *
     * @ORM\Column(name="factura_nro", type="string", length=45, nullable=true)
     */
    private $facturaNro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="factura_iva", type="string", length=45, nullable=true)
     */
    private $facturaIva;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_idcliente", referencedColumnName="idcliente")
     * })
     */
    private $clienteIdcliente;

    /**
     * @var \Vendedor
     *
     * @ORM\ManyToOne(targetEntity="Vendedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendedor_idvendedor", referencedColumnName="idvendedor")
     * })
     */
    private $vendedorIdvendedor;

    /*
        collection of products that are part of a purchase
    */

    protected $productos;

    public function __construct()
    {
        $this->productos=new ArrayCollection();
    }

    public function getProductos():Collection{
        return $this->productos;
    }

    public function getIdventa(): ?int
    {
        return $this->idventa;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(?string $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getFacturaNro(): ?string
    {
        return $this->facturaNro;
    }

    public function setFacturaNro(?string $facturaNro): self
    {
        $this->facturaNro = $facturaNro;

        return $this;
    }

    public function getFacturaIva(): ?string
    {
        return $this->facturaIva;
    }

    public function setFacturaIva(?string $facturaIva): self
    {
        $this->facturaIva = $facturaIva;

        return $this;
    }

    public function getClienteIdcliente(): ?Cliente
    {
        return $this->clienteIdcliente;
    }

    public function setClienteIdcliente(?Cliente $clienteIdcliente): self
    {
        $this->clienteIdcliente = $clienteIdcliente;

        return $this;
    }

    public function getVendedorIdvendedor(): ?Vendedor
    {
        return $this->vendedorIdvendedor;
    }

    public function setVendedorIdvendedor(?Vendedor $vendedorIdvendedor): self
    {
        $this->vendedorIdvendedor = $vendedorIdvendedor;

        return $this;
    }


}
