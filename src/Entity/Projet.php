<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'idprojet', targetEntity: Employer::class)]
    private Collection $employers;

    #[ORM\OneToMany(mappedBy: 'idprojet', targetEntity: Taches::class)]
    private Collection $taches;

    public function __construct()
    {
        $this->employers = new ArrayCollection();
        $this->taches = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Employer>
     */
    public function getEmployers(): Collection
    {
        return $this->employers;
    }

    public function addEmployer(Employer $employer): self
    {
        if (!$this->employers->contains($employer)) {
            $this->employers->add($employer);
            $employer->setIdprojet($this);
        }

        return $this;
    }

    public function removeEmployer(Employer $employer): self
    {
        if ($this->employers->removeElement($employer)) {
            // set the owning side to null (unless already changed)
            if ($employer->getIdprojet() === $this) {
                $employer->setIdprojet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Taches>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Taches $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
            $tach->setIdprojet($this);
        }

        return $this;
    }

    public function removeTach(Taches $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getIdprojet() === $this) {
                $tach->setIdprojet(null);
            }
        }

        return $this;
    }
}
