<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $OrderNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

      #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $shippedAt = null;

    #[ORM\ManyToOne(inversedBy: 'command')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    /**
     * @var Collection<int, OrderLine>
     */
    #[ORM\OneToMany(targetEntity: OrderLine::class, mappedBy: 'inside', orphanRemoval: true)]
    private Collection $orderLine;

    /**
     * @var Collection<int, Payment>
     */
    #[ORM\OneToMany(targetEntity: Payment::class, mappedBy: 'command')]
    private Collection $isPaid;

    public function __construct()
    {
        $this->orderLine = new ArrayCollection();
        $this->isPaid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?string
    {
        return $this->OrderNumber;
    }

    public function setOrderNumber(string $OrderNumber): static
    {
        $this->OrderNumber = $OrderNumber;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getShippedAt(): ?\DateTimeImmutable
    {
        return $this->shippedAt;
    }

    public function setShippedAt(?\DateTimeImmutable $shippedAt): static
    {
        $this->shippedAt = $shippedAt;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, OrderLine>
     */
    public function getOrderLine(): Collection
    {
        return $this->orderLine;
    }

    public function addOrderLine(OrderLine $orderLine): static
    {
        if (!$this->orderLine->contains($orderLine)) {
            $this->orderLine->add($orderLine);
            $orderLine->setInside($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): static
    {
        if ($this->orderLine->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getInside() === $this) {
                $orderLine->setInside(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getIsPaid(): Collection
    {
        return $this->isPaid;
    }

    public function addIsPaid(Payment $isPaid): static
    {
        if (!$this->isPaid->contains($isPaid)) {
            $this->isPaid->add($isPaid);
            $isPaid->setCommand($this);
        }

        return $this;
    }

    public function removeIsPaid(Payment $isPaid): static
    {
        if ($this->isPaid->removeElement($isPaid)) {
            // set the owning side to null (unless already changed)
            if ($isPaid->getCommand() === $this) {
                $isPaid->setCommand(null);
            }
        }

        return $this;
    }
}
