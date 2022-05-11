<?php

namespace App\Entity\Menu;

use App\Repository\Menu\FoodCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodCategoryRepository::class)]
class FoodCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $short;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'category')]
    private $foods;

    public function __construct()
    {
        $this->foods = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getShort(): ?int
    {
        return $this->short;
    }

    public function setShort(int $short): self
    {
        $this->short = $short;

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getFoods(): Collection
    {
        return $this->foods;
    }

    public function addFood(Menu $food): self
    {
        if (!$this->foods->contains($food)) {
            $this->foods[] = $food;
            $food->addCategory($this);
        }

        return $this;
    }

    public function removeFood(Menu $food): self
    {
        if ($this->foods->removeElement($food)) {
            $food->removeCategory($this);
        }

        return $this;
    }
}
