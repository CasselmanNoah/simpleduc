<?php

namespace App\Entity;

use App\Repository\TachesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TachesRepository::class)]
class Taches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Projet $idprojet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getIdprojet(): ?Projet
    {
        return $this->idprojet;
    }

    public function setIdprojet(?Projet $idprojet): self
    {
        $this->idprojet = $idprojet;

        return $this;
    }
}
