<?php

namespace App\Entity;

use App\Repository\BagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BagRepository::class)
 */
class Bag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $code;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="bags")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="bags")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=DistributionCenter::class, inversedBy="bagReception")
     */
    private $distributionCenter;

    /**
     * @ORM\OneToOne(targetEntity=BagReception::class, mappedBy="bag", cascade={"persist", "remove"})
     */
    private $bagReception;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getDistributionCenter(): ?DistributionCenter
    {
        return $this->distributionCenter;
    }

    public function setDistributionCenter(?DistributionCenter $distributionCenter): self
    {
        $this->distributionCenter = $distributionCenter;

        return $this;
    }

    public function getBagReception(): ?BagReception
    {
        return $this->bagReception;
    }

    public function setBagReception(BagReception $bagReception): self
    {
        // set the owning side of the relation if necessary
        if ($bagReception->getBag() !== $this) {
            $bagReception->setBag($this);
        }

        $this->bagReception = $bagReception;

        return $this;
    }

    public function __toString()
    {
        return $this->getCode();
    }
}
