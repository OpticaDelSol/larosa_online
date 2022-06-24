<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModoPago
 *
 * @ORM\Table(name="modo_pago")
 * @ORM\Entity
 */
class ModoPago
{
    /**
     * @var int
     *
     * @ORM\Column(name="idmodo_pago", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmodoPago;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

    public function getIdmodoPago(): ?int
    {
        return $this->idmodoPago;
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


}
