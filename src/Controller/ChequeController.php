<?php

namespace App\Controller;

use App\Entity\Cheque;
use App\Form\ChequeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cheque')]
class ChequeController extends AbstractController
{
    public static function getEntityFqcn(): string
    {
        return Cheque::class;
    }

    #[Route('/', name: 'app_cheque_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cheques = $entityManager
            ->getRepository(Cheque::class)
            ->findAll();

        return $this->render('cheque/index.html.twig', [
            'cheques' => $cheques,
        ]);
    }

    #[Route('/new', name: 'app_cheque_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cheque = new Cheque();
        $form = $this->createForm(ChequeType::class, $cheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cheque);
            $entityManager->flush();

            return $this->redirectToRoute('app_cheque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cheque/new.html.twig', [
            'cheque' => $cheque,
            'form' => $form,
        ]);
    }

    #[Route('/{idcheque}', name: 'app_cheque_show', methods: ['GET'])]
    public function show(Cheque $cheque): Response
    {
        return $this->render('cheque/show.html.twig', [
            'cheque' => $cheque,
        ]);
    }

    #[Route('/{idcheque}/edit', name: 'app_cheque_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cheque $cheque, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChequeType::class, $cheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cheque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cheque/edit.html.twig', [
            'cheque' => $cheque,
            'form' => $form,
        ]);
    }

    #[Route('/{idcheque}', name: 'app_cheque_delete', methods: ['POST'])]
    public function delete(Request $request, Cheque $cheque, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cheque->getIdcheque(), $request->request->get('_token'))) {
            $entityManager->remove($cheque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cheque_index', [], Response::HTTP_SEE_OTHER);
    }
}
