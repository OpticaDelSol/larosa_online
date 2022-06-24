<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cheque
 *
 * @ORM\Table(name="cheque", indexes={@ORM\Index(name="fk_cheque_banco1_idx", columns={"banco_idbanco"}), @ORM\Index(name="fk_cheque_cliente1_idx", columns={"cliente_idcliente"}), @ORM\Index(name="fk_cheque_cobro_modo_pago1_idx", columns={"cobro_modo_pago_idcobro_modo_pago"}), @ORM\Index(name="fk_cheque_vendedor1_idx", columns={"vendedor_idvendedor"})})
 * @ORM\Entity
 */
class Cheque
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcheque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcheque;

    /**
     * @var \Banco
     *
     * @ORM\ManyToOne(targetEntity="Banco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="banco_idbanco", referencedColumnName="idbanco")
     * })
     */
    private $bancoIdbanco;

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
     * @var \CobroModoPago
     *
     * @ORM\ManyToOne(targetEntity="CobroModoPago")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cobro_modo_pago_idcobro_modo_pago", referencedColumnName="idcobro_modo_pago")
     * })
     */
    private $cobroModoPagoIdcobroModoPago;

    /**
     * @var \Vendedor
     *
     * @ORM\ManyToOne(targetEntity="Vendedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendedor_idvendedor", referencedColumnName="idvendedor")
     * })
     */
    private $vendedorIdvendedor;

    public function getIdcheque(): ?int
    {
        return $this->idcheque;
    }

    public function getBancoIdbanco(): ?Banco
    {
        return $this->bancoIdbanco;
    }

    public function setBancoIdbanco(?Banco $bancoIdbanco): self
    {
        $this->bancoIdbanco = $bancoIdbanco;

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

    public function getCobroModoPagoIdcobroModoPago(): ?CobroModoPago
    {
        return $this->cobroModoPagoIdcobroModoPago;
    }

    public function setCobroModoPagoIdcobroModoPago(?CobroModoPago $cobroModoPagoIdcobroModoPago): self
    {
        $this->cobroModoPagoIdcobroModoPago = $cobroModoPagoIdcobroModoPago;

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
