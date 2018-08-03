<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TracksRepository")
 */
class Tracks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Albums", inversedBy="tracks")
     */
    private $idalbum;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_validated;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_publi;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="idtrack", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Relations", mappedBy="sampleur", orphanRemoval=true)
     */
    private $relations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Relations", mappedBy="original", orphanRemoval=true)
     */
    private $relations2;

    


    

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->relations = new ArrayCollection();
        $this->relations2 = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdalbum(): ?Albums
    {
        return $this->idalbum;
    }

    public function setIdalbum(?Albums $idalbum): self
    {
        $this->idalbum = $idalbum;

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




    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getDatePubli(): ?\DateTimeInterface
    {
        return $this->date_publi;
    }

    public function setDatePubli(?\DateTimeInterface $date_publi): self
    {
        $this->date_publi = $date_publi;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdtrack($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdtrack() === $this) {
                $comment->setIdtrack(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Relations[]
     */
    public function getRelations(): Collection
    {
        return $this->relations;
    }

    public function addRelation(Relations $relation): self
    {
        if (!$this->relations->contains($relation)) {
            $this->relations[] = $relation;
            $relation->setSampleur($this);
        }

        return $this;
    }

    public function removeRelation(Relations $relation): self
    {
        if ($this->relations->contains($relation)) {
            $this->relations->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getSampleur() === $this) {
                $relation->setSampleur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Relations[]
     */
    public function getRelations2(): Collection
    {
        return $this->relations2;
    }

    public function addRelations2(Relations $relations2): self
    {
        if (!$this->relations2->contains($relations2)) {
            $this->relations2[] = $relations2;
            $relations2->setOriginal($this);
        }

        return $this;
    }

    public function removeRelations2(Relations $relations2): self
    {
        if ($this->relations2->contains($relations2)) {
            $this->relations2->removeElement($relations2);
            // set the owning side to null (unless already changed)
            if ($relations2->getOriginal() === $this) {
                $relations2->setOriginal(null);
            }
        }

        return $this;
    }

    


}
