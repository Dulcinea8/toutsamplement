<?php

namespace App\Entity;

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
     * @ORM\Column(type="string", length=255)
     */
    private $lien;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_publi;

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
}
