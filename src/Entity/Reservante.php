<?php

namespace App\Entity;

use App\Repository\ReservanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Rfc4122\UuidInterface;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ReservanteRepository::class)
 */
class Reservante
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected string $id;
    /**
     * @ORM\ManyToOne(targetEntity=Celebracion::class, inversedBy="reservantes")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Celebracion $celebracion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $apellido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $telefono;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isPresente;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $documento;

    /**
     * @ORM\OneToMany(targetEntity=Invitado::class, mappedBy="enlace")
     * @ORM\OrderBy({"nombre"= "ASC"})
     */
    private Collection $invitados;

    public function __toString(): string
    {
        return $this->email . ' - ' .$this->apellido . ', '. $this->getNombre();
    }

    public function __construct()
    {
        $this->invitados = new ArrayCollection();
        $this->id = Uuid::uuid4()->toString();
    }



    public function getId(): ?string
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getIsPresente(): ?bool
    {
        return $this->isPresente;
    }

    public function setIsPresente(?bool $isPresente): self
    {
        $this->isPresente = $isPresente;

        return $this;
    }

    public function getDocumento(): ?string
    {
        return $this->documento;
    }

    public function setDocumento(string $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return Collection|Invitado[]
     */
    public function getInvitados(): Collection
    {
        return $this->invitados;
    }

    public function addInvitado(Invitado $invitado): self
    {
        if (!$this->invitados->contains($invitado)) {
            $this->invitados[] = $invitado;
            $invitado->setEnlace($this);
        }

        return $this;
    }

    public function removeInvitado(Invitado $invitado): self
    {
        if ($this->invitados->removeElement($invitado)) {
            // set the owning side to null (unless already changed)
            if ($invitado->getEnlace() === $this) {
                $invitado->setEnlace(null);
            }
        }

        return $this;
    }


}
