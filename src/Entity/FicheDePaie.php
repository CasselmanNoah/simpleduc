<?php

namespace App\Entity;

use App\Repository\FicheDePaieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheDePaieRepository::class)]
class FicheDePaie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $salaireBrut = null;

    #[ORM\Column(length: 10)]
    private ?string $salairenet = null;

    #[ORM\Column(length: 25)]
    private ?string $matricule = null;

    #[ORM\ManyToOne(inversedBy: 'ficheDePaies')]
    private ?Employer $idEmp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalaireBrut(): ?string
    {
        return $this->salaireBrut;
    }

    public function setSalaireBrut(string $salaireBrut): self
    {
        $this->salaireBrut = $salaireBrut;

        return $this;
    }

    public function getSalairenet(): ?string
    {
        return $this->salairenet;
    }

    public function setSalairenet(string $salairenet): self
    {
        $this->salairenet = $salairenet;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getIdEmp(): ?Employer
    {
        return $this->idEmp;
    }

    public function setIdEmp(?Employer $idEmp): self
    {
        $this->idEmp = $idEmp;

        return $this;
    }
}
