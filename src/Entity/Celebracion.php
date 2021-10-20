<?php

namespace App\Entity;

use App\Entity\Traits\OfertTrait;
use App\Repository\CelebracionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use IntlDateFormatter;
use App\Entity\Reservante;

/**
 * @ORM\Entity(repositoryClass=CelebracionRepository::class)
 */
class Celebracion
{

    use TimestampableEntity;
    use OfertTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected ?string $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $fechaCelebracionAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $capacidad;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="celebracions")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $creaEvento;

    /**
     * @ORM\OneToMany(targetEntity=Reservante::class, mappedBy="celebracion")
     */
    private Collection $reservantes;

    /**
     * @ORM\OneToMany(targetEntity=Invitado::class, mappedBy="celebracion")
     */
    private Collection $invitados;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $descripcion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isHabilitada;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $imageQr;

    /**
     * @ORM\OneToMany(targetEntity=WaitingList::class, mappedBy="celebracion")
     */
    private Collection $waitingLists;

    /**
     * @ORM\ManyToMany(targetEntity=GroupCelebration::class, mappedBy="celebraciones")
     */
    private Collection $groupCelebrations;

    /**
     * @ORM\ManyToMany(targetEntity=CuerpoMail::class)
     */
    private Collection $cuerpoMail;


    public function __toString()
    {
        $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
        $formatter->setPattern(" d 'de' MMMM");
//      return $this->getNombre() . ' ' . date_format($this->getFechaCelebracionAt(), 'd/M');
      return $this->getNombre() . ' ' . $formatter->format($this->getFechaCelebracionAt());
    }

    public function __construct()
    {
        $this->reservantes = new ArrayCollection();
        $this->invitados = new ArrayCollection();
        $this->waitingLists = new ArrayCollection();
        $this->groupCelebrations = new ArrayCollection();
        $this->cuerpoMail = new ArrayCollection();
    }



    public function getId(): ?string
    {
        return $this->id;
    }

    public function getFechaCelebracionAt(): ?DateTimeInterface
    {
        return $this->fechaCelebracionAt;
    }

    public function setFechaCelebracionAt(DateTimeInterface $fechaCelebracionAt): self
    {
        $this->fechaCelebracionAt = $fechaCelebracionAt;

        return $this;
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

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(int $capacidad): self
    {
        $this->capacidad = $capacidad;

        return $this;
    }




    public function getCreaEvento(): ?User
    {
        return $this->creaEvento;
    }

    public function setCreaEvento(?User $creaEvento): self
    {
        $this->creaEvento = $creaEvento;

        return $this;
    }

    /**
     * @return Collection|Reservante[]
     */
    public function getReservantes(): Collection
    {
        return $this->reservantes;
    }

    public function addReservante(Reservante $reservante): self
    {
        if (!$this->reservantes->contains($reservante)) {
            $this->reservantes[] = $reservante;
            $reservante->setCelebracion($this);
        }

        return $this;
    }

    public function removeReservante(Reservante $reservante): self
    {
        if ($this->reservantes->removeElement($reservante)) {
            // set the owning side to null (unless already changed)
            if ($reservante->getCelebracion() === $this) {
                $reservante->setCelebracion(null);
            }
        }

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
            $invitado->setCelebracion($this);
        }

        return $this;
    }

    public function removeInvitado(Invitado $invitado): self
    {
        if ($this->invitados->removeElement($invitado)) {
            // set the owning side to null (unless already changed)
            if ($invitado->getCelebracion() === $this) {
                $invitado->setCelebracion(null);
            }
        }

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getIsHabilitada(): ?bool
    {
        return $this->isHabilitada;
    }

    public function setIsHabilitada(?bool $isHabilitada): self
    {
        $this->isHabilitada = $isHabilitada;

        return $this;
    }

    public function getImageQr(): ?string
    {
        return $this->imageQr;
    }

    public function setImageQr(?string $imageQr): self
    {
        $this->imageQr = $imageQr;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInvitadosPresentes(): ?int
    {
        $criterio = CelebracionRepository::createIsPresenteCriteria();
        return count($this->invitados->matching($criterio));
    }

    /**
     * @return Collection|WaitingList[]
     */
    public function getWaitingLists(): Collection
    {
        return $this->waitingLists;
    }

    public function addWaitingList(WaitingList $waitingList): self
    {
        if (!$this->waitingLists->contains($waitingList)) {
            $this->waitingLists[] = $waitingList;
            $waitingList->setCelebracion($this);
        }

        return $this;
    }

    public function removeWaitingList(WaitingList $waitingList): self
    {
        if ($this->waitingLists->removeElement($waitingList)) {
            // set the owning side to null (unless already changed)
            if ($waitingList->getCelebracion() === $this) {
                $waitingList->setCelebracion(null);
            }
        }

        return $this;
    }


    public function getGroupCelebrations(): ArrayCollection
    {
        return $this->groupCelebrations;
    }

    public function addGroupCelebration(GroupCelebration $groupCelebration): self
    {
        if (!$this->groupCelebrations->contains($groupCelebration)) {
            $this->groupCelebrations[] = $groupCelebration;
            $groupCelebration->addCelebracione($this);
        }

        return $this;
    }

    public function removeGroupCelebration(GroupCelebration $groupCelebration): self
    {
        if ($this->groupCelebrations->removeElement($groupCelebration)) {
            $groupCelebration->removeCelebracione($this);
        }

        return $this;
    }

    /**
     * @return Collection|CuerpoMail[]
     */
    public function getCuerpoMail(): Collection
    {
        return $this->cuerpoMail;
    }

    public function addCuerpoMail(CuerpoMail $cuerpoMail): self
    {
        if (!$this->cuerpoMail->contains($cuerpoMail)) {
            $this->cuerpoMail[] = $cuerpoMail;
        }

        return $this;
    }

    public function removeCuerpoMail(CuerpoMail $cuerpoMail): self
    {
        $this->cuerpoMail->removeElement($cuerpoMail);

        return $this;
    }






}
