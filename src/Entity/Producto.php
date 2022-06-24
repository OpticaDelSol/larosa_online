<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto", indexes={@ORM\Index(name="fk_producto_grupo1_idx", columns={"grupo_idgrupo"})})
 * @ORM\Entity
 */
class Producto
{
    /**
     * @var int
     *
     * @ORM\Column(name="idproducto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproducto;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $fechaCreacion = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var \Grupo
     *
     * @ORM\ManyToOne(targetEntity="Grupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo_idgrupo", referencedColumnName="idgrupo")
     * })
     */
    private $grupoIdgrupo;

    public function getIdproducto(): ?int
    {
        return $this->idproducto;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(?\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getGrupoIdgrupo(): ?Grupo
    {
        return $this->grupoIdgrupo;
    }

    public function setGrupoIdgrupo(?Grupo $grupoIdgrupo): self
    {
        $this->grupoIdgrupo = $grupoIdgrupo;

        return $this;
    }


}
