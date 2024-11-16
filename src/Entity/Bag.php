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
     * @ORM\Column(type="string", length=255)
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
     * @ORM\OneToMany(targetEntity=BagReception::class, mappedBy="bag")
     */
    private $bagReceptions;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->bagReceptions = new ArrayCollection();
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

    /**
     * @return Collection<int, BagReception>
     */
    public function getBagReceptions(): Collection
    {
        return $this->bagReceptions;
    }

    public function addBagReception(BagReception $bagReception): self
    {
        if (!$this->bagReceptions->contains($bagReception)) {
            $this->bagReceptions[] = $bagReception;
            $bagReception->setBag($this);
        }

        return $this;
    }

    public function removeBagReception(BagReception $bagReception): self
    {
        if ($this->bagReceptions->removeElement($bagReception)) {
            // set the owning side to null (unless already changed)
            if ($bagReception->getBag() === $this) {
                $bagReception->setBag(null);
            }
        }

        return $this;
    }
}
