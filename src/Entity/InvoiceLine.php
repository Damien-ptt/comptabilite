<?php

namespace App\Entity;

use App\Repository\InvoiceLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceLineRepository::class)
 */
class InvoiceLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="invoiceLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $invoice;

    /**
     * @ORM\Column(type="text")
     */
    private $label;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTaxIncluded;

    /**
     * @ORM\Column(type="float")
     */
    private $amountVAT;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTotal;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTotalTaxIncluded;

    /**
     * @ORM\Column(type="float")
     */
    private $amountTotalVAT;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmountTaxIncluded(): ?float
    {
        return $this->amountTaxIncluded;
    }

    public function setAmountTaxIncluded(float $amountTaxIncluded): self
    {
        $this->amountTaxIncluded = $amountTaxIncluded;

        return $this;
    }

    public function getAmountVAT(): ?float
    {
        return $this->amountVAT;
    }

    public function setAmountVAT(float $amountVAT): self
    {
        $this->amountVAT = $amountVAT;

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

    public function getAmountTotalTaxIncluded(): ?float
    {
        return $this->amountTotalTaxIncluded;
    }

    public function setAmountTotalTaxIncluded(float $amountTotalTaxIncluded): self
    {
        $this->amountTotalTaxIncluded = $amountTotalTaxIncluded;

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
}