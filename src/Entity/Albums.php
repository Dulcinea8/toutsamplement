<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumsRepository")
 */
class Albums
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artistes", inversedBy="albums")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idartiste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(maxSize="1000k")
     */
    private $pochette;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tracks", mappedBy="idalbum")
     */
    private $tracks;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_validated;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
    }

    public function getId()
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

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(?string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getIdartiste(): ?Artistes
    {
        return $this->idartiste;
    }

    public function setIdartiste(?Artistes $idartiste): self
    {
        $this->idartiste = $idartiste;

        return $this;
    }

    public function getPochette()
    {
        return $this->pochette;
    }

    public function setPochette($pochette)
    {
        $this->pochette = $pochette;

        return $this;
    }

    /**
     * @return Collection|Tracks[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Tracks $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setIdalbum($this);
        }

        return $this;
    }

    public function removeTrack(Tracks $track): self
    {
        if ($this->tracks->contains($track)) {
            $this->tracks->removeElement($track);
            // set the owning side to null (unless already changed)
            if ($track->getIdalbum() === $this) {
                $track->setIdalbum(null);
            }
        }

        return $this;
    }
      public function getIsValidated(): ?bool
    {
        return $this->is_validated;
    }

    public function setIsValidated(bool $is_validated): self
    {
        $this->is_validated = $is_validated;

        return $this;
    }
}
