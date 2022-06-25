<?php

namespace App\Controller;

use App\Entity\Venta;
use App\Form\VentaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/venta')]
class VentaController extends AbstractController
{
    #[Route('/', name: 'app_venta_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ventas = $entityManager
            ->getRepository(Venta::class)
            ->findAll();

        return $this->render('venta/index.html.twig', [
            'ventas' => $ventas,
        ]);
    }

    #[Route('/new', name: 'app_venta_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ventum = new Venta();
        $form = $this->createForm(VentaType::class, $ventum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ventum);
            $entityManager->flush();

            return $this->redirectToRoute('app_venta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('venta/new.html.twig', [
            'ventum' => $ventum,
            'form' => $form,
        ]);
    }

    #[Route('/{idventa}', name: 'app_venta_show', methods: ['GET'])]
    public function show(Venta $ventum): Response
    {
        return $this->render('venta/show.html.twig', [
            'ventum' => $ventum,
        ]);
    }

    #[Route('/{idventa}/edit', name: 'app_venta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Venta $ventum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VentaType::class, $ventum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_venta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('venta/edit.html.twig', [
            'ventum' => $ventum,
            'form' => $form,
        ]);
    }

    #[Route('/{idventa}', name: 'app_venta_delete', methods: ['POST'])]
    public function delete(Request $request, Venta $ventum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ventum->getIdventa(), $request->request->get('_token'))) {
            $entityManager->remove($ventum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_venta_index', [], Response::HTTP_SEE_OTHER);
    }
}
