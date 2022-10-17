<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolesRepository::class)]
class Roles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50,unique:true)]
    private ?string $profession = null;

    #[ORM\OneToMany(mappedBy: 'idRoles', targetEntity: Employer::class)]
    private Collection $employers;

    #[ORM\OneToMany(mappedBy: 'Poste', targetEntity: Postulant::class)]
    private Collection $postulants;

    public function __construct()
    {
        $this->employers = new ArrayCollection();
        $this->postulants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

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
            $employer->setIdRoles($this);
        }

        return $this;
    }

    public function removeEmployer(Employer $employer): self
    {
        if ($this->employers->removeElement($employer)) {
            // set the owning side to null (unless already changed)
            if ($employer->getIdRoles() === $this) {
                $employer->setIdRoles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Postulant>
     */
    public function getPostulants(): Collection
    {
        return $this->postulants;
    }

    public function addPostulant(Postulant $postulant): self
    {
        if (!$this->postulants->contains($postulant)) {
            $this->postulants->add($postulant);
            $postulant->setPoste($this);
        }

        return $this;
    }

    public function removePostulant(Postulant $postulant): self
    {
        if ($this->postulants->removeElement($postulant)) {
            // set the owning side to null (unless already changed)
            if ($postulant->getPoste() === $this) {
                $postulant->setPoste(null);
            }
        }

        return $this;
    }
}
