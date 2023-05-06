<?php

namespace App\Service;

use App\Controller\InvoiceController;
use App\Entity\Invoice;
use App\Entity\InvoiceLine;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceService 
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function fillInvoice(Invoice $invoice)
    {
        if (!$invoice->getId()) { // Cas dans un new
            $lastInvoice = $this->entityManager->getRepository(Invoice::class)->findOneBy([], ['id' => 'desc']);
            $invoiceId = $lastInvoice->getId()+1;
            $now = new DateTime();
            $ref = $now->format('Y') . '-' . $invoice->getCustomer()->getCustomerCode() . '-' . $invoiceId;
            $invoice
                ->setReference($ref)
                ->setBankTransferReference('REF-'. $ref)
            ;
        }
        $coefTva = 1;
        $amountTotal = 0;
        $amountTotalVAT = 0;
        $amountTotalTaxIncluded = 0;
     
        /** @var InvoiceLine $invoiceLine */
        foreach ($invoice->getInvoiceLines() as $invoiceLine) {
            $amountTaxIncluded = $invoiceLine->getAmountTaxIncluded();
            $quantity = $invoiceLine->getQuantity();
            $amount = number_format($amountTaxIncluded/$coefTva,2);
            $amountVat = $amountTaxIncluded - $amount;
            $invoiceLine
                ->setAmount($amount)
                ->setAmountVAT($amountVat)
                ->setAmountTotal($quantity*$amount)
                ->setAmountTotalVAT($quantity*$amountVat)
                ->setAmountTotalTaxIncluded($quantity*$amountTaxIncluded)
            ;
            $amountTotal = $amountTotal + $invoiceLine->getAmountTotal();
            $amountTotalVAT = $amountTotalVAT + $invoiceLine->getAmountTotalVAT();
            $amountTotalTaxIncluded = $amountTotalTaxIncluded + $invoiceLine->getAmountTotalTaxIncluded();
        }
        $invoice->setAmountTotal($amountTotal);
        $invoice->setAmountTotalVAT($amountTotalVAT);
        $invoice->setAmountTotalIncluded($amountTotalTaxIncluded);

        return $invoice;
    }
}