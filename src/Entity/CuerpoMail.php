<?php

namespace App\Entity;

use App\Repository\CuerpoMailRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuerpoMailRepository::class)
 */
class CuerpoMail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=510)
     */
    private $texto;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActivo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHability;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textofirma;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $identificador;

    public function __toString()
    {
        return $this->nombre;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

        return $this;
    }

    public function getIsActivo(): ?bool
    {
        return $this->isActivo;
    }

    public function setIsActivo(bool $isActivo): self
    {
        $this->isActivo = $isActivo;

        return $this;
    }

    public function getIsHability(): ?bool
    {
        return $this->isHability;
    }

    public function setIsHability(bool $isHability): self
    {
        $this->isHability = $isHability;

        return $this;
    }

    public function getTextofirma(): ?string
    {
        return $this->textofirma;
    }

    public function setTextofirma(string $textofirma): self
    {
        $this->textofirma = $textofirma;

        return $this;
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

    public function getIdentificador(): ?string
    {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador): self
    {
        $this->identificador = $identificador;

        return $this;
    }

}
