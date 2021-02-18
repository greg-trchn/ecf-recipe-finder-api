<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AlimentRepository::class)
 */
class Aliment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"public"})
     */
    private $aliment_name;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, mappedBy="aliments")
     * @Groups({"public"})
     */
    private $recipes;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryAliment::class, inversedBy="aliments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"public"})
     */
    private $category;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlimentName(): ?string
    {
        return $this->aliment_name;
    }

    public function setAlimentName(string $aliment_name): self
    {
        $this->aliment_name = $aliment_name;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->addAliment($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            $recipe->removeAliment($this);
        }

        return $this;
    }

    public function getCategory(): ?CategoryAliment
    {
        return $this->category;
    }

    public function setCategory(?CategoryAliment $category): self
    {
        $this->category = $category;

        return $this;
    }
}
