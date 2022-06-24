<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColorHasPasoProduccion
 *
 * @ORM\Table(name="color_has_paso_produccion", indexes={@ORM\Index(name="fk_color_has_paso_produccion_paso_produccion1_idx", columns={"paso_produccion_idpaso_produccion"}), @ORM\Index(name="fk_color_has_paso_produccion_producto_produccion1_idx", columns={"producto_produccion_idproducto_prod"})})
 * @ORM\Entity
 */
class ColorHasPasoProduccion
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="ingreso", type="string", length=45, nullable=true)
     */
    private $ingreso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="egreso", type="string", length=45, nullable=true)
     */
    private $egreso;

    /**
     * @var \PasoProduccion
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="PasoProduccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paso_produccion_idpaso_produccion", referencedColumnName="idpaso_produccion")
     * })
     */
    private $pasoProduccionIdpasoProduccion;

    /**
     * @var \ProductoProduccion
     *
     * @ORM\ManyToOne(targetEntity="ProductoProduccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="producto_produccion_idproducto_prod", referencedColumnName="idproducto_prod")
     * })
     */
    private $productoProduccionIdproductoProd;

    public function getIngreso(): ?string
    {
        return $this->ingreso;
    }

    public function setIngreso(?string $ingreso): self
    {
        $this->ingreso = $ingreso;

        return $this;
    }

    public function getEgreso(): ?string
    {
        return $this->egreso;
    }

    public function setEgreso(?string $egreso): self
    {
        $this->egreso = $egreso;

        return $this;
    }

    public function getPasoProduccionIdpasoProduccion(): ?PasoProduccion
    {
        return $this->pasoProduccionIdpasoProduccion;
    }

    public function setPasoProduccionIdpasoProduccion(?PasoProduccion $pasoProduccionIdpasoProduccion): self
    {
        $this->pasoProduccionIdpasoProduccion = $pasoProduccionIdpasoProduccion;

        return $this;
    }

    public function getProductoProduccionIdproductoProd(): ?ProductoProduccion
    {
        return $this->productoProduccionIdproductoProd;
    }

    public function setProductoProduccionIdproductoProd(?ProductoProduccion $productoProduccionIdproductoProd): self
    {
        $this->productoProduccionIdproductoProd = $productoProduccionIdproductoProd;

        return $this;
    }


}
