<?php

namespace App\Entity;

use App\Repository\SoireeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoireeRepository::class)
 */
class Soiree
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="idSoiree")
     */
    private $idProjet;

    public function __construct()
    {
        $this->idProjet = new ArrayCollection();
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
     * @return Collection|Projet[]
     */
    public function getIdProjet(): Collection
    {
        return $this->idProjet;
    }

    public function addIdProjet(Projet $idProjet): self
    {
        if (!$this->idProjet->contains($idProjet)) {
            $this->idProjet[] = $idProjet;
            $idProjet->setIdSoiree($this);
        }

        return $this;
    }

    public function removeIdProjet(Projet $idProjet): self
    {
        if ($this->idProjet->removeElement($idProjet)) {
            // set the owning side to null (unless already changed)
            if ($idProjet->getIdSoiree() === $this) {
                $idProjet->setIdSoiree(null);
            }
        }

        return $this;
    }
}
