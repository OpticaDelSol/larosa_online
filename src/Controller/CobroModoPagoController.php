<?php

namespace App\Controller;

use App\Entity\CobroModoPago;
use App\Form\CobroModoPagoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cobro/modo/pago')]
class CobroModoPagoController extends AbstractController
{

    public static function getEntityFqcn(): string
    {
        return CobroModoPago::class;
    }

    #[Route('/', name: 'app_cobro_modo_pago_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cobroModoPagos = $entityManager
            ->getRepository(CobroModoPago::class)
            ->findAll();

        return $this->render('cobro_modo_pago/index.html.twig', [
            'cobro_modo_pagos' => $cobroModoPagos,
        ]);
    }

    #[Route('/new', name: 'app_cobro_modo_pago_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cobroModoPago = new CobroModoPago();
        $form = $this->createForm(CobroModoPagoType::class, $cobroModoPago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cobroModoPago);
            $entityManager->flush();

            return $this->redirectToRoute('app_cobro_modo_pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cobro_modo_pago/new.html.twig', [
            'cobro_modo_pago' => $cobroModoPago,
            'form' => $form,
        ]);
    }

    #[Route('/{idcobroModoPago}', name: 'app_cobro_modo_pago_show', methods: ['GET'])]
    public function show(CobroModoPago $cobroModoPago): Response
    {
        return $this->render('cobro_modo_pago/show.html.twig', [
            'cobro_modo_pago' => $cobroModoPago,
        ]);
    }

    #[Route('/{idcobroModoPago}/edit', name: 'app_cobro_modo_pago_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CobroModoPago $cobroModoPago, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CobroModoPagoType::class, $cobroModoPago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cobro_modo_pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cobro_modo_pago/edit.html.twig', [
            'cobro_modo_pago' => $cobroModoPago,
            'form' => $form,
        ]);
    }

    #[Route('/{idcobroModoPago}', name: 'app_cobro_modo_pago_delete', methods: ['POST'])]
    public function delete(Request $request, CobroModoPago $cobroModoPago, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cobroModoPago->getIdcobroModoPago(), $request->request->get('_token'))) {
            $entityManager->remove($cobroModoPago);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cobro_modo_pago_index', [], Response::HTTP_SEE_OTHER);
    }
}
