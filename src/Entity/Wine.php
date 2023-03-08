<?php

namespace App\Entity;

use App\Repository\WineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WineRepository::class)]
class Wine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $DO = null;

    #[ORM\Column(length: 255)]
    private ?string $ficha = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $maridaje = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDO(): ?string
    {
        return $this->DO;
    }

    public function setDO(string $DO): self
    {
        $this->DO = $DO;

        return $this;
    }

    public function getFicha(): ?string
    {
        return $this->ficha;
    }

    public function setFicha(string $ficha): self
    {
        $this->ficha = $ficha;

        return $this;
    }

    public function getMaridaje(): ?string
    {
        return $this->maridaje;
    }

    public function setMaridaje(?string $maridaje): self
    {
        $this->maridaje = $maridaje;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }
}
