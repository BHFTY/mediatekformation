<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    /**
     * Début de chemin vers les images
     */
    private const CHEMIN_IMAGE = "https://i.ytimg.com/vi/";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $publishedAt = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $videoId = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    private ?Playlist $playlist = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'formations')]
    private Collection $categories;

    /**
     * constructeur
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * 
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * 
     * @return \DateTimeInterface|null
     */
    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    /**
     * 
     * @param \DateTimeInterface|null $publishedAt
     * @return self
     */
    public function setPublishedAt(?\DateTimeInterface $publishedAt): static
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getPublishedAtString(): string
    {
        return $this->publishedAt ? $this->publishedAt->format('d/m/Y') : '';
    }

    /**
     * 
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * 
     * @param string|null $title
     * @return self
     */
    public function setTitle(?string $title): static
    {
        $this->title = $title;
        return $this;
    }

    /**
     * 
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * 
     * @param string|null $description
     * @return self
     */
    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    /**
     * 
     * @return string|null
     */
    public function getVideoId(): ?string
    {
        return $this->videoId;
    }

    /**
     * 
     * @param string|null $videoId
     * @return self
     */
    public function setVideoId(?string $videoId): static
    {
        $this->videoId = $videoId;
        return $this;
    }

    /**
     * 
     * @return string|null
     */
    public function getMiniature(): ?string
    {
        return self::CHEMIN_IMAGE . $this->videoId . "/default.jpg";
    }

    /**
     * 
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return self::CHEMIN_IMAGE . $this->videoId . "/hqdefault.jpg";
    }

    /**
     * 
     * @return Playlist|null
     */
    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    /**
     * 
     * @param Playlist|null $playlist
     * @return self
     */
    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;
        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * 
     * @param Categorie $category
     * @return self
     */
    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
        return $this;
    }

    /**
     * 
     * @param Categorie $category
     * @return self
     *
     */
    public function removeCategory(Categorie $category): static
    {
        $this->categories->removeElement($category);
        return $this;
    }
}
