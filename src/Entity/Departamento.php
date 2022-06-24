<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="departamento", indexes={@ORM\Index(name="fk_departamento_provincia1_idx", columns={"provincia_idprovincia"})})
 * @ORM\Entity
 */
class Departamento
{
    /**
     * @var int
     *
     * @ORM\Column(name="iddepartamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddepartamento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

    /**
     * @var \Provincia
     *
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provincia_idprovincia", referencedColumnName="idprovincia")
     * })
     */
    private $provinciaIdprovincia;

    public function getIddepartamento(): ?int
    {
        return $this->iddepartamento;
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

    public function getProvinciaIdprovincia(): ?Provincia
    {
        return $this->provinciaIdprovincia;
    }

    public function setProvinciaIdprovincia(?Provincia $provinciaIdprovincia): self
    {
        $this->provinciaIdprovincia = $provinciaIdprovincia;

        return $this;
    }


}
