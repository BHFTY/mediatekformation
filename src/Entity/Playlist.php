<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Formation>
     */
    #[ORM\OneToMany(targetEntity: Formation::class, mappedBy: 'playlist')]
    private Collection $formations;

    /**
     * constructeur
     */
    public function __construct()
    {
        $this->formations = new ArrayCollection();
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * 
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): static
    {
        $this->name = $name;

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
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    /**
     * 
     * @param Formation $formation
     * @return self
     */
    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->setPlaylist($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        if ($this->formations->removeElement($formation) && $formation->getPlaylist() === $this) {
            // set the owning side to null (unless already changed)
            $formation->setPlaylist(null);
        }

        return $this;
    }

    public function getCategoriesPlaylist(): Collection
    {
        $categoriesNames = [];
        
        foreach ($this->formations as $formation) {
            $categoriesFormation = $formation->getCategories();
            
            foreach ($categoriesFormation as $categorieFormation) {
                $name = $categorieFormation->getName();
                // Utilisez la fonction `in_array` pour vérifier les doublons
                if (!in_array($name, $categoriesNames)) {
                    $categoriesNames[] = $name; 
                }
            }
        }

        // Convertir les noms en ArrayCollection
        return new ArrayCollection($categoriesNames);
    }

    // Nouvelle méthode pour obtenir le nombre de formations
    /**
     * 
     * @return int
     */
    public function getFormationCount(): int
    {
        return $this->formations->count();
    }
}

