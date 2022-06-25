<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localidad
 *
 * @ORM\Table(name="localidad", indexes={@ORM\Index(name="fk_localidad_departamento1_idx", columns={"departamento_iddepartamento"})})
 * @ORM\Entity
 */
class Localidad
{
    /**
     * @var int
     *
     * @ORM\Column(name="idlocalidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlocalidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

    /**
     * @var \Departamento
     *
     * @ORM\ManyToOne(targetEntity="Departamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="departamento_iddepartamento", referencedColumnName="iddepartamento")
     * })
     */
    private $departamentoIddepartamento;

    public function getIdlocalidad(): ?int
    {
        return $this->idlocalidad;
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

    public function getDepartamentoIddepartamento(): ?Departamento
    {
        return $this->departamentoIddepartamento;
    }

    public function setDepartamentoIddepartamento(?Departamento $departamentoIddepartamento): self
    {
        $this->departamentoIddepartamento = $departamentoIddepartamento;

        return $this;
    }

    public function __toString()
    {
    return (string) $this->nombre;
    }


}
