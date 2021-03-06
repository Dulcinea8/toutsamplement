<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ORM\Table(name="users")
 * @UniqueEntity(fields="email", message="L'email que vous avez indiqué est déjà utilisé")
 * @UniqueEntity(fields="username", message="L'username que vous avez indiqué est déjà utilisé")
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=80, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(maxSize="1000k")
     */
    private $avatar;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_inscription;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $soundcloud;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bandcamp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site_web;

    /**
     * @ORM\Column(type="text", nullable=true, nullable=true)
     */
    private $bio;

    /**
     * @ORM\Column(name = "role", type="array")
     */
    private $role;


    /**
     * @param mixed
     * @Assert\Regex(pattern = "/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{6,}/", message= "le mot de passe doit contenir au moins 6 caracteres et au moins une lettre majuscule, une minuscule et un chiffre" )
     */
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="iduser", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Relations", mappedBy="user", orphanRemoval=true)
     */
    private $samples;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Articles", mappedBy="auteur", orphanRemoval=true)
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Artistes", mappedBy="user", orphanRemoval=true)
     */
    private $artistes;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->samples = new ArrayCollection();
        $this->artistes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getSoundcloud(): ?string
    {
        return $this->soundcloud;
    }

    public function setSoundcloud(?string $soundcloud): self
    {
        $this->soundcloud = $soundcloud;

        return $this;
    }

    public function getBandcamp(): ?string
    {
        return $this->bandcamp;
    }

    public function setBandcamp(?string $bandcamp): self
    {
        $this->bandcamp = $bandcamp;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->site_web;
    }

    public function setSiteWeb(?string $site_web): self
    {
        $this->site_web = $site_web;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->role;
    }

    public function setRoles(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getArtistes(): ?Users
    {
        return $this->artistes;
    }
    public function setArtistes(Users $artistes): self
    {
        $this->auteur = $artistes;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getUser(): Collection
    {
        return $this->comments;
    }

    public function addUser(Comments $user): self
    {
        if (!$this->comments->contains($user)) {
            $this->comments[] = $user;
            $user->setIduser($this);
        }

        return $this;
    }

    public function removeUser(Comments $user): self
    {
        if ($this->comments->contains($user)) {
            $this->comments->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getIduser() === $this) {
                $user->setIduser(null);
            }
        }

        return $this;
    }



    //méthodes de UserInterface à implementer
    public function eraseCredentials()
    {
        //par mesure de securite on va effacer le mdp en clair
        $this->plainPassword=null;

    }
    public function getSalt()
    {
        //ON va utiliser l'encoder bcrypt de Symfony
        // qui va lui meme gerer le salt
        // on est quand meme obligé d'ecrire cette methode car on imprement l'interface UserInterface
        return null;
    }

    public function serialize(){
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            //see section on salt below
            // $this->>salt
        ));
    }

    public function unserialize($serialized){
        list(
            $this->id,
            $this->username,
            $this->password,
            //see section on salt below
            // $this->>salt
            )= unserialize($serialized,['allowed_classes'=>false]);
    }

    public function getSamples(): Collection
    {
        return $this->samples;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticles(): Collection{
        return $this->articles;
    }




}
