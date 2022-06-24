<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cobro
 *
 * @ORM\Table(name="cobro", indexes={@ORM\Index(name="fk_cobro_cliente1_idx", columns={"cliente_idcliente"}), @ORM\Index(name="fk_cobro_vendedor1_idx", columns={"vendedor_idvendedor"})})
 * @ORM\Entity
 */
class Cobro
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcobro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcobro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="monto_total", type="string", length=45, nullable=true)
     */
    private $montoTotal;

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

    public function getIdcobro(): ?int
    {
        return $this->idcobro;
    }

    public function getMontoTotal(): ?string
    {
        return $this->montoTotal;
    }

    public function setMontoTotal(?string $montoTotal): self
    {
        $this->montoTotal = $montoTotal;

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
