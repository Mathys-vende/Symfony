<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="integer")
     */
    private $Part;

    /**
     * @ORM\ManyToOne(targetEntity=Soiree::class, inversedBy="idProjet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSoiree;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Apayer;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Arecevoir;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getPart(): ?int
    {
        return $this->Part;
    }

    public function setPart(int $Part): self
    {
        $this->Part = $Part;

        return $this;
    }

    public function getIdSoiree(): ?Soiree
    {
        return $this->idSoiree;
    }

    public function setIdSoiree(?Soiree $idSoiree): self
    {
        $this->idSoiree = $idSoiree;

        return $this;
    }

    public function getApayer(): ?float
    {
        return $this->Apayer;
    }

    public function setApayer(?float $Apayer): self
    {
        $this->Apayer = $Apayer;

        return $this;
    }

    public function getArecevoir(): ?float
    {
        return $this->Arecevoir;
    }

    public function setArecevoir(?float $Arecevoir): self
    {
        $this->Arecevoir = $Arecevoir;

        return $this;
    }

}
