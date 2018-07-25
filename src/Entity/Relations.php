<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Tracks", inversedBy="relations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sampleur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tracks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $original;

    public function getId()
    {
        return $this->id;
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
}
