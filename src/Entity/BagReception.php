<?php

namespace App\Entity;

use App\Repository\BagReceptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BagReceptionRepository::class)
 */
class BagReception
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
    private $bagCode;

    /**
     * @ORM\Column(type="date")
     */
    private $receptionDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $responsable;

    /**
     * @ORM\ManyToOne(targetEntity=DistributionCenter::class, inversedBy="bagReceptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $distributionCenter;

    /**
     * @ORM\ManyToOne(targetEntity=Bag::class, inversedBy="bagReceptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bag;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBagCode(): ?string
    {
        return $this->bagCode;
    }

    public function setBagCode(string $bagCode): self
    {
        $this->bagCode = $bagCode;

        return $this;
    }

    public function getReceptionDate(): ?\DateTimeInterface
    {
        return $this->receptionDate;
    }

    public function setReceptionDate(\DateTimeInterface $receptionDate): self
    {
        $this->receptionDate = $receptionDate;

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

    public function getDistributionCenter(): ?DistributionCenter
    {
        return $this->distributionCenter;
    }

    public function setDistributionCenter(?DistributionCenter $distributionCenter): self
    {
        $this->distributionCenter = $distributionCenter;

        return $this;
    }

    public function getBag(): ?Bag
    {
        return $this->bag;
    }

    public function setBag(?Bag $bag): self
    {
        $this->bag = $bag;

        return $this;
    }
}