<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\Company;
use App\Entity\InvoiceLine;
use App\Form\InvoiceType;
use App\Repository\InvoiceRepository;
use App\Service\InvoiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/invoice")
 */
class InvoiceController extends AbstractController
{
    /**
     * @Route("/", name="invoice_index", methods={"GET"})
     */
    public function index(InvoiceRepository $invoiceRepository): Response
    {
        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoiceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="invoice_new", methods={"GET","POST"})
     */
    public function new(Request $request,InvoiceService $invoiceService): Response
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invoice = $invoiceService->fillInvoice($invoice);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('invoice_index');
        }

        return $this->render('invoice/new.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invoice_show", methods={"GET"})
     */
    public function show(Invoice $invoice): Response
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->find(1);
     
        if ($company == null) {
            return $this->redirectToRoute('company_new');
        }

        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice,
            'company' => $company,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="invoice_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Invoice $invoice, InvoiceService $invoiceService): Response
    {
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invoice = $invoiceService->fillInvoice($invoice);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invoice_index');
        }

        return $this->render('invoice/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invoice_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Invoice $invoice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invoice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($invoice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('invoice_index');
    }
}