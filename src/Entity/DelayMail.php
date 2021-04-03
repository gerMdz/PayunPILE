<?php

namespace App\Entity;

use App\Repository\DelayMailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DelayMailRepository::class)
 */
class DelayMail
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $template;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creacionAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $prioridad;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $entity;

    public function __construct()
    {
        $this->creacionAt = new \DateTime('now');
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getCreacionAt(): ?\DateTimeInterface
    {
        return $this->creacionAt;
    }

    public function setCreacionAt(\DateTimeInterface $creacionAt): self
    {
        $this->creacionAt = $creacionAt;

        return $this;
    }

    public function getPrioridad(): ?int
    {
        return $this->prioridad;
    }

    public function setPrioridad(int $prioridad): self
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }
}
