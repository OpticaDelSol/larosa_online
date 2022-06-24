<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table(name="grupo", indexes={@ORM\Index(name="fk_grupo_familia1_idx", columns={"familia_idfamilia"})})
 * @ORM\Entity
 */
class Grupo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idgrupo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgrupo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="precio_comun", type="string", length=45, nullable=true)
     */
    private $precioComun;

    /**
     * @var \Familia
     *
     * @ORM\ManyToOne(targetEntity="Familia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="familia_idfamilia", referencedColumnName="idfamilia")
     * })
     */
    private $familiaIdfamilia;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Vendedor", inversedBy="grupoIdgrupo")
     * @ORM\JoinTable(name="precio_grupo_vendedor",
     *   joinColumns={
     *     @ORM\JoinColumn(name="grupo_idgrupo", referencedColumnName="idgrupo")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="vendedor_idvendedor", referencedColumnName="idvendedor")
     *   }
     * )
     */
    private $vendedorIdvendedor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vendedorIdvendedor = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdgrupo(): ?int
    {
        return $this->idgrupo;
    }

    public function getPrecioComun(): ?string
    {
        return $this->precioComun;
    }

    public function setPrecioComun(?string $precioComun): self
    {
        $this->precioComun = $precioComun;

        return $this;
    }

    public function getFamiliaIdfamilia(): ?Familia
    {
        return $this->familiaIdfamilia;
    }

    public function setFamiliaIdfamilia(?Familia $familiaIdfamilia): self
    {
        $this->familiaIdfamilia = $familiaIdfamilia;

        return $this;
    }

    /**
     * @return Collection<int, Vendedor>
     */
    public function getVendedorIdvendedor(): Collection
    {
        return $this->vendedorIdvendedor;
    }

    public function addVendedorIdvendedor(Vendedor $vendedorIdvendedor): self
    {
        if (!$this->vendedorIdvendedor->contains($vendedorIdvendedor)) {
            $this->vendedorIdvendedor[] = $vendedorIdvendedor;
        }

        return $this;
    }

    public function removeVendedorIdvendedor(Vendedor $vendedorIdvendedor): self
    {
        $this->vendedorIdvendedor->removeElement($vendedorIdvendedor);

        return $this;
    }

}
