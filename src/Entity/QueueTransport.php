<?php

namespace App\Entity;

use App\Repository\QueueTransportRepository;
use Doctrine\ORM\Mapping as ORM;
use Hashids\Hashids;

/**
 * @ORM\Entity(repositoryClass=QueueTransportRepository::class)
 */
class QueueTransport
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $queue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isBlock;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $inicioAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $finalAt;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $hashkey;

    public function __construct()
    {
        $hashids = new Hashids($this->queue, 10);
        $this->hashkey = $hashids->encode(1, 2, 3);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getQueue(): ?string
    {
        return $this->queue;
    }

    public function setQueue(string $queue): self
    {
        $this->queue = $queue;

        return $this;
    }

    public function getIsBlock(): ?bool
    {
        return $this->isBlock;
    }

    public function setIsBlock(bool $isBlock): self
    {
        $this->isBlock = $isBlock;

        return $this;
    }

    public function getInicioAt(): ?\DateTimeInterface
    {
        return $this->inicioAt;
    }

    public function setInicioAt(\DateTimeInterface $inicioAt): self
    {
        $this->inicioAt = $inicioAt;

        return $this;
    }

    public function getFinalAt(): ?\DateTimeInterface
    {
        return $this->finalAt;
    }

    public function setFinalAt(?\DateTimeInterface $finalAt): self
    {
        $this->finalAt = $finalAt;

        return $this;
    }

    public function getHashkey(): ?string
    {
        return $this->hashkey;
    }

    public function setHashkey(string $hashkey): self
    {
        $this->hashkey = $hashkey;

        return $this;
    }
}
