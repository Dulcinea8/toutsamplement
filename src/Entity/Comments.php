<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Articles", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idarticle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tracks", inversedBy="comments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idtrack;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="comments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $iduser;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
    * @ORM\Column(type="datetime")
    */
    private $date_publi;

    public function getId()
    {
        return $this->id;
    }

    public function getIdArticle(): ?Articles
    {
        return $this->idarticle;
    }

    public function setIdArticle(?Articles $idarticle): self
    {
        $this->idarticle = $idarticle;

        return $this;
    }

    public function getIdtrack(): ?Tracks
    {
        return $this->idtrack;
    }

    public function setIdtrack(?Tracks $idtrack): self
    {
        $this->idtrack = $idtrack;

        return $this;
    }

    public function getIduser(): ?Users
    {
        return $this->iduser;
    }

    public function setIduser(?Users $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }
    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage( $message)
    {
        $this->message = $message;

        return $this;
    }

    public function getDatePubli(): ?\DateTimeInterface
    {
        return $this->date_publi;
    }

    public function setDatePubli(\DateTimeInterface $date_publi): self
    {
        $this->date_publi = $date_publi;

        return $this;
    }
}
