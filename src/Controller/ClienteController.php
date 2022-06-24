<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cliente')]
class ClienteController extends AbstractController
{
    #[Route('/', name: 'app_cliente_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $clientes = $entityManager
            ->getRepository(Cliente::class)
            ->findAll();

        return $this->render('cliente/index.html.twig', [
            'clientes' => $clientes,
        ]);
    }

    #[Route('/new', name: 'app_cliente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cliente);
            $entityManager->flush();

            return $this->redirectToRoute('app_cliente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cliente/new.html.twig', [
            'cliente' => $cliente,
            'form' => $form,
        ]);
    }

    #[Route('/{idcliente}', name: 'app_cliente_show', methods: ['GET'])]
    public function show(Cliente $cliente): Response
    {
        return $this->render('cliente/show.html.twig', [
            'cliente' => $cliente,
        ]);
    }

    #[Route('/{idcliente}/edit', name: 'app_cliente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cliente $cliente, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cliente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cliente/edit.html.twig', [
            'cliente' => $cliente,
            'form' => $form,
        ]);
    }

    #[Route('/{idcliente}', name: 'app_cliente_delete', methods: ['POST'])]
    public function delete(Request $request, Cliente $cliente, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cliente->getIdcliente(), $request->request->get('_token'))) {
            $entityManager->remove($cliente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cliente_index', [], Response::HTTP_SEE_OTHER);
    }
}
