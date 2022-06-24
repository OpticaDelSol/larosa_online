<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Familia
 *
 * @ORM\Table(name="familia", uniqueConstraints={@ORM\UniqueConstraint(name="nombre_UNIQUE", columns={"nombre"})})
 * @ORM\Entity
 */
class Familia
{
    /**
     * @var int
     *
     * @ORM\Column(name="idfamilia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfamilia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    public function getIdfamilia(): ?int
    {
        return $this->idfamilia;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }


}
