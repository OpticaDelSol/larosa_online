<?php

namespace App\Controller;

use App\Entity\Banco;
use App\Form\BancoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/banco')]
class BancoController extends AbstractController
{
    #[Route('/', name: 'app_banco_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $bancos = $entityManager
            ->getRepository(Banco::class)
            ->findAll();

        return $this->render('banco/index.html.twig', [
            'bancos' => $bancos,
        ]);
    }

    #[Route('/new', name: 'app_banco_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $banco = new Banco();
        $form = $this->createForm(BancoType::class, $banco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($banco);
            $entityManager->flush();

            return $this->redirectToRoute('app_banco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('banco/new.html.twig', [
            'banco' => $banco,
            'form' => $form,
        ]);
    }

    #[Route('/{idbanco}', name: 'app_banco_show', methods: ['GET'])]
    public function show(Banco $banco): Response
    {
        return $this->render('banco/show.html.twig', [
            'banco' => $banco,
        ]);
    }

    #[Route('/{idbanco}/edit', name: 'app_banco_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Banco $banco, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BancoType::class, $banco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_banco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('banco/edit.html.twig', [
            'banco' => $banco,
            'form' => $form,
        ]);
    }

    #[Route('/{idbanco}', name: 'app_banco_delete', methods: ['POST'])]
    public function delete(Request $request, Banco $banco, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$banco->getIdbanco(), $request->request->get('_token'))) {
            $entityManager->remove($banco);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_banco_index', [], Response::HTTP_SEE_OTHER);
    }
}
