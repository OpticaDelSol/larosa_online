<?php

namespace App\Controller;

use App\Entity\ModoPago;
use App\Form\ModoPagoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/modo/pago')]
class ModoPagoController extends AbstractController
{
    #[Route('/', name: 'app_modo_pago_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $modoPagos = $entityManager
            ->getRepository(ModoPago::class)
            ->findAll();

        return $this->render('modo_pago/index.html.twig', [
            'modo_pagos' => $modoPagos,
        ]);
    }

    #[Route('/new', name: 'app_modo_pago_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $modoPago = new ModoPago();
        $form = $this->createForm(ModoPagoType::class, $modoPago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($modoPago);
            $entityManager->flush();

            return $this->redirectToRoute('app_modo_pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modo_pago/new.html.twig', [
            'modo_pago' => $modoPago,
            'form' => $form,
        ]);
    }

    #[Route('/{idmodoPago}', name: 'app_modo_pago_show', methods: ['GET'])]
    public function show(ModoPago $modoPago): Response
    {
        return $this->render('modo_pago/show.html.twig', [
            'modo_pago' => $modoPago,
        ]);
    }

    #[Route('/{idmodoPago}/edit', name: 'app_modo_pago_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ModoPago $modoPago, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModoPagoType::class, $modoPago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_modo_pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modo_pago/edit.html.twig', [
            'modo_pago' => $modoPago,
            'form' => $form,
        ]);
    }

    #[Route('/{idmodoPago}', name: 'app_modo_pago_delete', methods: ['POST'])]
    public function delete(Request $request, ModoPago $modoPago, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modoPago->getIdmodoPago(), $request->request->get('_token'))) {
            $entityManager->remove($modoPago);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_modo_pago_index', [], Response::HTTP_SEE_OTHER);
    }
}
