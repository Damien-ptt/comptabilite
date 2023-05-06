<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
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
    private $reference;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bankTransferReference;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="invoices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTotal = 0;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTotalIncluded = 0;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTotalVAT = 0;

    /**
     * @ORM\OneToMany(targetEntity=InvoiceLine::class, mappedBy="invoice", cascade={"persist"})
     */
    private $invoiceLines;

    public function __construct()
    {
        $this->invoiceLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getBankTransferReference(): ?string
    {
        return $this->bankTransferReference;
    }

    public function setBankTransferReference(?string $bankTransferReference): self
    {
        $this->bankTransferReference = $bankTransferReference;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getAmountTotal(): ?float
    {
        return $this->amountTotal;
    }

    public function setAmountTotal(float $amountTotal): self
    {
        $this->amountTotal = $amountTotal;

        return $this;
    }

    public function getAmountTotalIncluded(): ?float
    {
        return $this->amountTotalIncluded;
    }

    public function setAmountTotalIncluded(float $amountTotalIncluded): self
    {
        $this->amountTotalIncluded = $amountTotalIncluded;

        return $this;
    }

    public function getAmountTotalVAT(): ?float
    {
        return $this->amountTotalVAT;
    }

    public function setAmountTotalVAT(float $amountTotalVAT): self
    {
        $this->amountTotalVAT = $amountTotalVAT;

        return $this;
    }

    /**
     * @return Collection|InvoiceLine[]
     */
    public function getInvoiceLines(): Collection
    {
        return $this->invoiceLines;
    }

    public function addInvoiceLine(InvoiceLine $invoiceLine): self
    {
        if (!$this->invoiceLines->contains($invoiceLine)) {
            $this->invoiceLines[] = $invoiceLine;
            $invoiceLine->setInvoice($this);
        }

        return $this;
    }

    public function removeInvoiceLine(InvoiceLine $invoiceLine): self
    {
        if ($this->invoiceLines->removeElement($invoiceLine)) {
            // set the owning side to null (unless already changed)
            if ($invoiceLine->getInvoice() === $this) {
                $invoiceLine->setInvoice(null);
            }
        }

        return $this;
    }
}
