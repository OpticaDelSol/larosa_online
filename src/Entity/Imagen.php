<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imagen
 *
 * @ORM\Table(name="imagen", indexes={@ORM\Index(name="fk_imagen_modelo_color1_idx", columns={"modelo_color_idcolor"})})
 * @ORM\Entity
 */
class Imagen
{
    /**
     * @var int
     *
     * @ORM\Column(name="idimagen", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idimagen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var \Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modelo_color_idcolor", referencedColumnName="idproducto")
     * })
     */
    private $modeloColorIdcolor;

    public function getIdimagen(): ?int
    {
        return $this->idimagen;
    }

    public function getRuta(): ?string
    {
        return $this->ruta;
    }

    public function setRuta(?string $ruta): self
    {
        $this->ruta = $ruta;

        return $this;
    }

    public function getModeloColorIdcolor(): ?Producto
    {
        return $this->modeloColorIdcolor;
    }

    public function setModeloColorIdcolor(?Producto $modeloColorIdcolor): self
    {
        $this->modeloColorIdcolor = $modeloColorIdcolor;

        return $this;
    }


}
