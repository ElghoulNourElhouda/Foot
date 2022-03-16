<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use App\Entity\Statistique;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Joueur;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $niveau;

    #[ORM\OneToMany(mappedBy: 'equipe', targetEntity: Statistique::class)]
    private $statistiquesequipe;


    #[ORM\OneToMany(targetEntity: Joueur::class, mappedBy: 'equipe')]
    private $joueurs;

    public function __construct()
    {
        $this->statistiquesequipe = new ArrayCollection();
        $this->joueurs = new ArrayCollection();
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

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Statistique>
     */
    public function getStatistiquesequipe(): Collection
    {
        return $this->statistiquesequipe;
    }

    public function addStatistiquesequipe(Statistique $statistiquesequipe): self
    {
        if (!$this->statistiquesequipe->contains($statistiquesequipe)) {
            $this->statistiquesequipe[] = $statistiquesequipe;
            $statistiquesequipe->setEquipe($this);
        }

        return $this;
    }

    public function removeStatistiquesequipe(Statistique $statistiquesequipe): self
    {
        if ($this->statistiquesequipe->removeElement($statistiquesequipe)) {
            // set the owning side to null (unless already changed)
            if ($statistiquesequipe->getEquipe() === $this) {
                $statistiquesequipe->setEquipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
            $joueur->setEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): self
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getEquipe() === $this) {
                $joueur->setEquipe(null);
            }
        }

        return $this;
    }

    

  
  
    

    
 
}
