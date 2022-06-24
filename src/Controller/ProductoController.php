<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Form\ProductoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/producto')]
class ProductoController extends AbstractController
{
    #[Route('/', name: 'app_producto_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $productos = $entityManager
            ->getRepository(Producto::class)
            ->findAll();

        return $this->render('producto/index.html.twig', [
            'productos' => $productos,
        ]);
    }

    #[Route('/new', name: 'app_producto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('app_producto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('producto/new.html.twig', [
            'producto' => $producto,
            'form' => $form,
        ]);
    }

    #[Route('/{idproducto}', name: 'app_producto_show', methods: ['GET'])]
    public function show(Producto $producto): Response
    {
        return $this->render('producto/show.html.twig', [
            'producto' => $producto,
        ]);
    }

    #[Route('/{idproducto}/edit', name: 'app_producto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Producto $producto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_producto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('producto/edit.html.twig', [
            'producto' => $producto,
            'form' => $form,
        ]);
    }

    #[Route('/{idproducto}', name: 'app_producto_delete', methods: ['POST'])]
    public function delete(Request $request, Producto $producto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$producto->getIdproducto(), $request->request->get('_token'))) {
            $entityManager->remove($producto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_producto_index', [], Response::HTTP_SEE_OTHER);
    }
}
