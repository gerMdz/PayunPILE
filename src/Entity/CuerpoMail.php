<?php

namespace App\Entity;

use App\Repository\CuerpoMailRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=510)
     */
    private ?string $texto;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActivo;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isEnable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $textoFirma;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $nombre;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private ?string $identificador;

    private ArrayCollection $celebracion;

    public function __toString()
    {
        return $this->nombre;
    }

    public function __construct()
    {
        $this->celebracion = new ArrayCollection();
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

    public function getIsEnable(): ?bool
    {
        return $this->isEnable;
    }

    public function setIsEnable(bool $isEnable): self
    {
        $this->isEnable = $isEnable;

        return $this;
    }

    public function getTextoFirma(): ?string
    {
        return $this->textoFirma;
    }

    public function setTextoFirma(string $textoFirma): self
    {
        $this->textoFirma = $textoFirma;

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

    /**
     * @return Collection|Celebracion[]
     */
    public function getCelebracion(): Collection
    {
        return $this->celebracion;
    }

    public function addCelebracion(Celebracion $celebracion): self
    {
        if (!$this->celebracion->contains($celebracion)) {
            $this->celebracion[] = $celebracion;
            $celebracion->setCuerpoMail($this);
        }

        return $this;
    }

    public function removeCelebracion(Celebracion $celebracion): self
    {
        if ($this->celebracion->removeElement($celebracion)) {
            // set the owning side to null (unless already changed)
            if ($celebracion->getCuerpoMail() === $this) {
                $celebracion->setCuerpoMail(null);
            }
        }

        return $this;
    }
}
