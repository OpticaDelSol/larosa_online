<?php

namespace App\Controller;

use App\Entity\Departamento;
use App\Form\DepartamentoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/departamento')]
class DepartamentoController extends AbstractController
{
    #[Route('/', name: 'app_departamento_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $departamentos = $entityManager
            ->getRepository(Departamento::class)
            ->findAll();

        return $this->render('departamento/index.html.twig', [
            'departamentos' => $departamentos,
        ]);
    }

    #[Route('/new', name: 'app_departamento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $departamento = new Departamento();
        $form = $this->createForm(DepartamentoType::class, $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($departamento);
            $entityManager->flush();

            return $this->redirectToRoute('app_departamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departamento/new.html.twig', [
            'departamento' => $departamento,
            'form' => $form,
        ]);
    }

    #[Route('/{iddepartamento}', name: 'app_departamento_show', methods: ['GET'])]
    public function show(Departamento $departamento): Response
    {
        return $this->render('departamento/show.html.twig', [
            'departamento' => $departamento,
        ]);
    }

    #[Route('/{iddepartamento}/edit', name: 'app_departamento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Departamento $departamento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DepartamentoType::class, $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_departamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departamento/edit.html.twig', [
            'departamento' => $departamento,
            'form' => $form,
        ]);
    }

    #[Route('/{iddepartamento}', name: 'app_departamento_delete', methods: ['POST'])]
    public function delete(Request $request, Departamento $departamento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$departamento->getIddepartamento(), $request->request->get('_token'))) {
            $entityManager->remove($departamento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_departamento_index', [], Response::HTTP_SEE_OTHER);
    }
}
