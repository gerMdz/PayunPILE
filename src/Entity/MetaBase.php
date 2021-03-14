<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetaBaseRepository")
 */
class MetaBase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $lema;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $lemaPrincipal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaDescripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $metaAutor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $siteName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $base;

    public function __construct()
    {
        $this->base = 'index';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLema(): ?string
    {
        return $this->lema;
    }

    public function setLema(?string $lema): self
    {
        $this->lema = $lema;

        return $this;
    }

    public function getLemaPrincipal(): ?string
    {
        return $this->lemaPrincipal;
    }

    public function setLemaPrincipal(string $lemaPrincipal): self
    {
        $this->lemaPrincipal = $lemaPrincipal;

        return $this;
    }

    public function getMetaDescripcion(): ?string
    {
        return $this->metaDescripcion;
    }

    public function setMetaDescripcion(string $metaDescripcion): self
    {
        $this->metaDescripcion = $metaDescripcion;

        return $this;
    }

    public function getMetaAutor(): ?string
    {
        return $this->metaAutor;
    }

    public function setMetaAutor(?string $metaAutor): self
    {
        $this->metaAutor = $metaAutor;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaType(): ?string
    {
        return $this->metaType;
    }

    public function setMetaType(string $metaType): self
    {
        $this->metaType = $metaType;

        return $this;
    }

    public function getMetaUrl(): ?string
    {
        return $this->metaUrl;
    }

    public function setMetaUrl(string $metaUrl): self
    {
        $this->metaUrl = $metaUrl;

        return $this;
    }

    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): self
    {
        $this->siteName = $siteName;

        return $this;
    }

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function setBase(string $base): self
    {
        $this->base = $base;

        return $this;
    }
}
