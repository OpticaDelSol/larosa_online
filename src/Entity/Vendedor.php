<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vendedor
 *
 * @ORM\Table(name="vendedor", indexes={@ORM\Index(name="fk_vendedor_localidad1_idx", columns={"localidad_idlocalidad"})})
 * @ORM\Entity
 */
class Vendedor
{
    /**
     * @var int
     *
     * @ORM\Column(name="idvendedor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvendedor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

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
     * @var \Localidad
     *
     * @ORM\ManyToOne(targetEntity="Localidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localidad_idlocalidad", referencedColumnName="idlocalidad")
     * })
     */
    private $localidadIdlocalidad;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Grupo", mappedBy="vendedorIdvendedor")
     */
    private $grupoIdgrupo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->grupoIdgrupo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdvendedor(): ?int
    {
        return $this->idvendedor;
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

    public function getLocalidadIdlocalidad(): ?Localidad
    {
        return $this->localidadIdlocalidad;
    }

    public function setLocalidadIdlocalidad(?Localidad $localidadIdlocalidad): self
    {
        $this->localidadIdlocalidad = $localidadIdlocalidad;

        return $this;
    }

    /**
     * @return Collection<int, Grupo>
     */
    public function getGrupoIdgrupo(): Collection
    {
        return $this->grupoIdgrupo;
    }

    public function addGrupoIdgrupo(Grupo $grupoIdgrupo): self
    {
        if (!$this->grupoIdgrupo->contains($grupoIdgrupo)) {
            $this->grupoIdgrupo[] = $grupoIdgrupo;
            $grupoIdgrupo->addVendedorIdvendedor($this);
        }

        return $this;
    }

    public function removeGrupoIdgrupo(Grupo $grupoIdgrupo): self
    {
        if ($this->grupoIdgrupo->removeElement($grupoIdgrupo)) {
            $grupoIdgrupo->removeVendedorIdvendedor($this);
        }

        return $this;
    }

}
