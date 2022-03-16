<?php

namespace App\Entity;

use App\Repository\StatistiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Saison;
use App\Entity\Equipe;
use App\Entity\Joueur;
#[ORM\Entity(repositoryClass: StatistiqueRepository::class)]
class Statistique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $nbrematchs;

    #[ORM\Column(type: 'integer')]
    private $nbrebuts;

    #[ORM\Column(type: 'integer')]
    private $nbreminutes;

    #[ORM\Column(type: 'integer')]
    private $nbrepasses;


    #[ORM\ManyToOne(targetEntity: Joueur::class, inversedBy: 'statistiques' )]
    private $joueur;

    #[ORM\ManyToOne(targetEntity: Equipe::class, inversedBy: 'statistiquesequipe' )]
    private $equipe;
    
    #[ORM\ManyToOne(targetEntity: Saison::class, inversedBy: 'statistiques' )]
    private $saison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrematchs(): ?int
    {
        return $this->nbrematchs;
    }

    public function setNbrematchs(int $nbrematchs): self
    {
        $this->nbrematchs = $nbrematchs;

        return $this;
    }

    public function getNbrebuts(): ?int
    {
        return $this->nbrebuts;
    }

    public function setNbrebuts(int $nbrebuts): self
    {
        $this->nbrebuts = $nbrebuts;

        return $this;
    }

    public function getNbreminutes(): ?int
    {
        return $this->nbreminutes;
    }

    public function setNbreminutes(int $nbreminutes): self
    {
        $this->nbreminutes = $nbreminutes;

        return $this;
    }

    public function getNbrepasses(): ?int
    {
        return $this->nbrepasses;
    }

    public function setNbrepasses(int $nbrepasses): self
    {
        $this->nbrepasses = $nbrepasses;

        return $this;
    }

    public function getJoueur(): ?Joueur
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueur $joueur): self
    {
        $this->joueur = $joueur;

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    public function setSaison(?Saison $saison): self
    {
        $this->saison = $saison;

        return $this;
    }

      
}