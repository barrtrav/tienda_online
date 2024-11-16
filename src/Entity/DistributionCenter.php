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
     * @ORM\OneToMany(targetEntity=Bag::class, mappedBy="distributionCenter")
     */
    private $bagReception;

    /**
     * @ORM\OneToMany(targetEntity=BagReception::class, mappedBy="distributionCenter")
     */
    private $bagReceptions;

    public function __construct()
    {
        $this->bagReception = new ArrayCollection();
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

    /**
     * @return Collection<int, Bag>
     */
    public function getBagReception(): Collection
    {
        return $this->bagReception;
    }

    public function addBagReception(Bag $bagReception): self
    {
        if (!$this->bagReception->contains($bagReception)) {
            $this->bagReception[] = $bagReception;
            $bagReception->setDistributionCenter($this);
        }

        return $this;
    }

    public function removeBagReception(Bag $bagReception): self
    {
        if ($this->bagReception->removeElement($bagReception)) {
            // set the owning side to null (unless already changed)
            if ($bagReception->getDistributionCenter() === $this) {
                $bagReception->setDistributionCenter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BagReception>
     */
    public function getBagReceptions(): Collection
    {
        return $this->bagReceptions;
    }
}
