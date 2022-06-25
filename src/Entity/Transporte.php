<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transporte
 *
 * @ORM\Table(name="transporte", indexes={@ORM\Index(name="fk_transporte_cliente1_idx", columns={"cliente_idcliente"})})
 * @ORM\Entity
 */
class Transporte
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtransporte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtransporte;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="string", length=45, nullable=true)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre_corto", type="string", length=45, nullable=true)
     */
    private $nombreCorto;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_idcliente", referencedColumnName="idcliente")
     * })
     */
    private $clienteIdcliente;

    public function getIdtransporte(): ?int
    {
        return $this->idtransporte;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getNombreCorto(): ?string
    {
        return $this->nombreCorto;
    }

    public function setNombreCorto(?string $nombreCorto): self
    {
        $this->nombreCorto = $nombreCorto;

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
    public function __toString()
    {
    return (string) $this->nombreCorto;
    }

}
