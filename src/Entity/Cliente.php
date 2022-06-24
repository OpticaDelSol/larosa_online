<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente", indexes={@ORM\Index(name="fk_cliente_localidad1_idx", columns={"localidad_idlocalidad"})})
 * @ORM\Entity
 */
class Cliente
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcliente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cuit", type="string", length=45, nullable=true)
     */
    private $cuit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="direccion", type="string", length=45, nullable=true)
     */
    private $direccion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IVA", type="string", length=45, nullable=true)
     */
    private $iva;

    /**
     * @var \Localidad
     *
     * @ORM\ManyToOne(targetEntity="Localidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localidad_idlocalidad", referencedColumnName="idlocalidad")
     * })
     */
    private $localidadIdlocalidad;

    public function getIdcliente(): ?int
    {
        return $this->idcliente;
    }

    public function getCuit(): ?string
    {
        return $this->cuit;
    }

    public function setCuit(?string $cuit): self
    {
        $this->cuit = $cuit;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getIva(): ?string
    {
        return $this->iva;
    }

    public function setIva(?string $iva): self
    {
        $this->iva = $iva;

        return $this;
    }

    public function getLocalidadIdlocalidad(): ?Localidad
    {
        return $this->localidadIdlocalidad;
    }

    public function setLocalidadIdlocalidad(?Localidad $localidadIdlocalidad): self
    {
        $this->localidadIdlocalidad = $localidadIdlocalidad;

        return $this;
    }


}
