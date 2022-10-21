<?php

namespace App\Entity;

use App\Repository\EmployerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: EmployerRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Employer implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 25)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?bool $permis = null;

    #[ORM\OneToMany(mappedBy: 'idEmp', targetEntity: FicheDePaie::class)]
    private Collection $ficheDePaies;

    #[ORM\ManyToOne(inversedBy: 'employers')]
    private ?Roles $idRoles = null;

    #[ORM\OneToMany(mappedBy: 'idEmployer', targetEntity: Projet::class)]
    private Collection $projets;

    public function __construct()
    {
        $this->ficheDePaies = new ArrayCollection();
        $this->projets = new ArrayCollection();
    }

    public function getId(): ?int
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function isPermis(): ?bool
    {
        return $this->permis;
    }

    public function setPermis(bool $permis): self
    {
        $this->permis = $permis;

        return $this;
    }

    /**
     * @return Collection<int, FicheDePaie>
     */
    public function getFicheDePaies(): Collection
    {
        return $this->ficheDePaies;
    }

    public function addFicheDePaie(FicheDePaie $ficheDePaie): self
    {
        if (!$this->ficheDePaies->contains($ficheDePaie)) {
            $this->ficheDePaies->add($ficheDePaie);
            $ficheDePaie->setIdEmp($this);
        }

        return $this;
    }

    public function removeFicheDePaie(FicheDePaie $ficheDePaie): self
    {
        if ($this->ficheDePaies->removeElement($ficheDePaie)) {
            // set the owning side to null (unless already changed)
            if ($ficheDePaie->getIdEmp() === $this) {
                $ficheDePaie->setIdEmp(null);
            }
        }

        return $this;
    }

    public function getIdRoles(): ?Roles
    {
        return $this->idRoles;
    }

    public function setIdRoles(?Roles $idRoles): self
    {
        $this->idRoles = $idRoles;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setIdEmployer($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getIdEmployer() === $this) {
                $projet->setIdEmployer(null);
            }
        }

        return $this;
    }
}
