<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Users;
use App\Entity\Relations;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="idarticle", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_publi;

    /**
     * cette propriété fait reference à l'entite Users
     * il s'agit d'une relation ManyToOne
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="articles")
     */
    private $auteur;

    /**
     * @ORM\Column(type="string")
     * @Assert\Image(maxSize="1000k")
     */
    private $image;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $video;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Relations", mappedBy="articles", cascade={"persist", "remove"})
     */
    private $relations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Likes", mappedBy="article")
     */
    private $likes;

    

    

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getVideo()
    {
        return $this->video;
    }
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    public function getAuteurId(): ?Users
    {
        return $this->auteur;
    }
    public function setAuteurId(Users $auteur): self
    {
        $this->auteur = $auteur;

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
            $comment->setIdarticle($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdarticle() === $this) {
                $comment->setIdarticle(null);
            }
        }

        return $this;
    }

    public function getRelations(): ?Relations
    {
        return $this->relations;
    }

    public function setRelations(?Relations $relations): self
    {
        $this->relations = $relations;

        // set (or unset) the owning side of the relation if necessary
        $newArticles = $relations === null ? null : $this;
        if ($newArticles !== $relations->getArticles()) {
            $relations->setArticles($newArticles);
        }

        return $this;
    }

    /**
     * @return Collection|Likes[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Likes $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->addArticle($this);
        }

        return $this;
    }

    public function removeLike(Likes $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            $like->removeArticle($this);
        }

        return $this;
    }

    

    
}
