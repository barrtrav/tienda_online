<?php

namespace App\Entity;

use App\Repository\DistributionCenterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DistributionCenterRepository::class)
 */
class DistributionCenter
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $responsable;

    /**
     * @ORM\Column(type="integer")
     */
    private $bagsDelivered;

    /**
     * @ORM\Column(type="date")
     */
    private $deliveryDate;

    /**
     * @ORM\OneToOne(targetEntity=Warehouse::class, inversedBy="distributionCenter", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $warehouse;

    /**
     * @ORM\OneToMany(targetEntity=BagReception::class, mappedBy="distributionCenter", orphanRemoval=true)
     */
    private $bagReceptions;

    public function __construct()
    {
        $this->bagReceptions = new ArrayCollection();
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

    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(string $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getBagsDelivered(): ?string
    {
        return $this->bagsDelivered;
    }

    public function setBagsDelivered(string $bagsDelivered): self
    {
        $this->bagsDelivered = $bagsDelivered;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getWarehouse(): ?Warehouse
    {
        return $this->warehouse;
    }

    public function setWarehouse(Warehouse $warehouse): self
    {
        $this->warehouse = $warehouse;

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
        try{

            if (!$this->bagReceptions->contains($bagReception)) {
                $this->bagReceptions[] = $bagReception;
                $this->setBagsDelivered($this->getBagsDelivered() + 1);
                $bagReception->setDistributionCenter($this);
            }
        }catch (\Exception $e) {}

        return $this;
    }

    public function removeBagReception(BagReception $bagReception): self
    {
        if ($this->bagReceptions->removeElement($bagReception)) {
            // set the owning side to null (unless already changed)
            if ($bagReception->getDistributionCenter() === $this) {
                $bagReception->setDistributionCenter(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
