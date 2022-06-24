<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoProduccion
 *
 * @ORM\Table(name="paso_produccion")
 * @ORM\Entity
 */
class PasoProduccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="idpaso_produccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoProduccion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=true)
     */
    private $nombre;

    public function getIdpasoProduccion(): ?int
    {
        return $this->idpasoProduccion;
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
