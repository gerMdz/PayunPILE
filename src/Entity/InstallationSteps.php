<?php

namespace App\Entity;

use App\Repository\InstallationStepsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InstallationStepsRepository::class)
 */
class InstallationSteps
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_admin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_event;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_logo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_base;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_config_mailer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_metabase;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_available;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(?\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->is_admin;
    }

    public function setIsAdmin(?bool $is_admin): self
    {
        $this->is_admin = $is_admin;

        return $this;
    }

    public function getNameEvent(): ?string
    {
        return $this->name_event;
    }

    public function setNameEvent(?string $name_event): self
    {
        $this->name_event = $name_event;

        return $this;
    }

    public function getIsLogo(): ?bool
    {
        return $this->is_logo;
    }

    public function setIsLogo(?bool $is_logo): self
    {
        $this->is_logo = $is_logo;

        return $this;
    }

    public function getIsBase(): ?bool
    {
        return $this->is_base;
    }

    public function setIsBase(?bool $is_base): self
    {
        $this->is_base = $is_base;

        return $this;
    }

    public function getIsConfigMailer(): ?bool
    {
        return $this->is_config_mailer;
    }

    public function setIsConfigMailer(?bool $is_config_mailer): self
    {
        $this->is_config_mailer = $is_config_mailer;

        return $this;
    }

    public function getIsMetabase(): ?bool
    {
        return $this->is_metabase;
    }

    public function setIsMetabase(?bool $is_metabase): self
    {
        $this->is_metabase = $is_metabase;

        return $this;
    }

    public function getIsAvailable(): ?bool
    {
        return $this->is_available;
    }

    public function setIsAvailable(?bool $is_available): self
    {
        $this->is_available = $is_available;

        return $this;
    }
}
