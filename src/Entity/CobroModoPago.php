<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CobroModoPago
 *
 * @ORM\Table(name="cobro_modo_pago", indexes={@ORM\Index(name="fk_cobro_modo_pago_cobro1_idx", columns={"cobro_idcobro"}), @ORM\Index(name="fk_cobro_modo_pago_modo_pago1_idx", columns={"modo_pago_idmodo_pago"})})
 * @ORM\Entity
 */
class CobroModoPago
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcobro_modo_pago", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcobroModoPago;

    /**
     * @var \Cobro
     *
     * @ORM\ManyToOne(targetEntity="Cobro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cobro_idcobro", referencedColumnName="idcobro")
     * })
     */
    private $cobroIdcobro;

    /**
     * @var \ModoPago
     *
     * @ORM\ManyToOne(targetEntity="ModoPago")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modo_pago_idmodo_pago", referencedColumnName="idmodo_pago")
     * })
     */
    private $modoPagoIdmodoPago;

    public function getIdcobroModoPago(): ?int
    {
        return $this->idcobroModoPago;
    }

    public function getCobroIdcobro(): ?Cobro
    {
        return $this->cobroIdcobro;
    }

    public function setCobroIdcobro(?Cobro $cobroIdcobro): self
    {
        $this->cobroIdcobro = $cobroIdcobro;

        return $this;
    }

    public function getModoPagoIdmodoPago(): ?ModoPago
    {
        return $this->modoPagoIdmodoPago;
    }

    public function setModoPagoIdmodoPago(?ModoPago $modoPagoIdmodoPago): self
    {
        $this->modoPagoIdmodoPago = $modoPagoIdmodoPago;

        return $this;
    }


}
