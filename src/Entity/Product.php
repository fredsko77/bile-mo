<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     * @Groups({"product:read", "product:list"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=32)
     * @Groups({"product:read", "product:list"})
     */
    private $brand;

    /**
     * @ORM\Column(type="text")
     * @Groups({"product:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Groups({"product:read", "product:list"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"product:read"})
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=32)
     * @Groups({"product:read"})
     */
    private $os;

    /**
     * @ORM\Column(type="json")
     * @Groups({"product:read"})
     */
    private $network = [];

    /**
     * @ORM\Column(type="json")
     * @Groups({"product:read"})
     */
    private $color = [];

    /**
     * @ORM\Column(type="json")
     * @Groups({"product:read"})
     */
    private $connectivity = [];

    /**
     * @ORM\Column(type="json")
     * @Groups({"product:read"})
     */
    private $memory = [];

    /**
     * @ORM\Column(type="float")
     * @Groups({"product:read"})
     */
    private $screen;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"product:read"})
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"product:read", "product:list"})
     */
    private $ref;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getOs(): ?string
    {
        return $this->os;
    }

    public function setOs(string $os): self
    {
        $this->os = $os;

        return $this;
    }

    public function getNetwork(): ?array
    {
        return $this->network;
    }

    public function setNetwork(array $network): self
    {
        $this->network = $network;

        return $this;
    }

    public function getColor(): ?array
    {
        return $this->color;
    }

    public function setColor(array $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getConnectivity(): ?array
    {
        return $this->connectivity;
    }

    public function setConnectivity(array $connectivity): self
    {
        $this->connectivity = $connectivity;

        return $this;
    }

    public function getMemory(): ?array
    {
        return $this->memory;
    }

    public function setMemory(array $memory): self
    {
        $this->memory = $memory;

        return $this;
    }

    public function getScreen(): ?float
    {
        return $this->screen;
    }

    public function setScreen(float $screen): self
    {
        $this->screen = $screen;

        return $this;
    }

    public function getPhoto(): ?int
    {
        return $this->photo;
    }

    public function setPhoto(int $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
