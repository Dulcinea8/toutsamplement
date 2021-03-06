<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Tracks;
use App\Entity\Articles;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RelationsRepository")
 */
class Relations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_validated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="samples")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tracks", inversedBy="relations")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sampleur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tracks", inversedBy="relations2")
     * @ORM\JoinColumn(nullable=true)
     */
    private $original;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Articles", inversedBy="relations", cascade={"persist", "remove"})
     */
    private $articles;

    public function getId()
    {
        return $this->id;
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
    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(Users $user): self
    {
        //toma el utilisateur connecté
        $this->user = $user;
        return $this;
    }


    public function getSampleur(): ?Tracks
    {
        return $this->sampleur;
    }

    public function setSampleur(?Tracks $sampleur): self
    {
        $this->sampleur = $sampleur;

        return $this;
    }

    public function getOriginal(): ?Tracks
    {
        return $this->original;
    }

    public function setOriginal(?Tracks $original): self
    {
        $this->original = $original;

        return $this;
    }

    public function getArticles(): ?Articles
    {
        return $this->articles;
    }

    public function setArticles(?Articles $articles): self
    {
        $this->articles = $articles;

        return $this;
    }
}
