<?php

namespace App\Entity;

use App\Repository\WaitingListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WaitingListRepository::class)
 */
class WaitingList
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $apellido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $email;

    /**
     * @ORM\ManyToOne(targetEntity=Celebracion::class, inversedBy="waitingLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Celebracion $celebracion;

    public function __toString(): ?string
    {
        return $this->email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCelebracion(): ?Celebracion
    {
        return $this->celebracion;
    }

    public function setCelebracion(?Celebracion $celebracion): self
    {
        $this->celebracion = $celebracion;

        return $this;
    }
}
