<?php

namespace App\Controller;

use App\Entity\ProductoHasVenta;
use App\Form\ProductoHasVentaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/producto/has/venta')]
class ProductoHasVentaController extends AbstractController
{
    #[Route('/', name: 'app_producto_has_venta_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $productoHasVentas = $entityManager
            ->getRepository(ProductoHasVenta::class)
            ->findAll();

        return $this->render('producto_has_venta/index.html.twig', [
            'producto_has_ventas' => $productoHasVentas,
        ]);
    }

    #[Route('/new', name: 'app_producto_has_venta_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productoHasVentum = new ProductoHasVenta();
        $form = $this->createForm(ProductoHasVentaType::class, $productoHasVentum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productoHasVentum);
            $entityManager->flush();

            return $this->redirectToRoute('app_producto_has_venta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('producto_has_venta/new.html.twig', [
            'producto_has_ventum' => $productoHasVentum,
            'form' => $form,
        ]);
    }

    #[Route('/{ventaIdventa}', name: 'app_producto_has_venta_show', methods: ['GET'])]
    public function show(ProductoHasVenta $productoHasVentum): Response
    {
        return $this->render('producto_has_venta/show.html.twig', [
            'producto_has_ventum' => $productoHasVentum,
        ]);
    }

    #[Route('/{ventaIdventa}/edit', name: 'app_producto_has_venta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductoHasVenta $productoHasVentum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductoHasVentaType::class, $productoHasVentum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_producto_has_venta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('producto_has_venta/edit.html.twig', [
            'producto_has_ventum' => $productoHasVentum,
            'form' => $form,
        ]);
    }

    #[Route('/{ventaIdventa}', name: 'app_producto_has_venta_delete', methods: ['POST'])]
    public function delete(Request $request, ProductoHasVenta $productoHasVentum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productoHasVentum->getVentaIdventa(), $request->request->get('_token'))) {
            $entityManager->remove($productoHasVentum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_producto_has_venta_index', [], Response::HTTP_SEE_OTHER);
    }
}
