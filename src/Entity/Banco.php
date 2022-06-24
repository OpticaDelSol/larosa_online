<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banco
 *
 * @ORM\Table(name="banco")
 * @ORM\Entity
 */
class Banco
{
    /**
     * @var int
     *
     * @ORM\Column(name="idbanco", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbanco;

    /**
     * @var string|null
     *
     * @ORM\Column(name="banco", type="string", length=45, nullable=true)
     */
    private $banco;

    public function getIdbanco(): ?int
    {
        return $this->idbanco;
    }

    public function getBanco(): ?string
    {
        return $this->banco;
    }

    public function setBanco(?string $banco): self
    {
        $this->banco = $banco;

        return $this;
    }


}
