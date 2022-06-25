<?php

namespace App\Controller;

use App\Entity\Familia;
use App\Form\FamiliaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/familia')]
class FamiliaController extends AbstractController
{
    public static function getEntityFqcn(): string
    {
        return Familia::class;
    }

    #[Route('/', name: 'app_familia_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $familias = $entityManager
            ->getRepository(Familia::class)
            ->findAll();

        return $this->render('familia/index.html.twig', [
            'familias' => $familias,
        ]);
    }

    #[Route('/new', name: 'app_familia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $familium = new Familia();
        $form = $this->createForm(FamiliaType::class, $familium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($familium);
            $entityManager->flush();

            return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('familia/new.html.twig', [
            'familium' => $familium,
            'form' => $form,
        ]);
    }

    #[Route('/{idfamilia}', name: 'app_familia_show', methods: ['GET'])]
    public function show(Familia $familium): Response
    {
        return $this->render('familia/show.html.twig', [
            'familium' => $familium,
        ]);
    }

    #[Route('/{idfamilia}/edit', name: 'app_familia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Familia $familium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FamiliaType::class, $familium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('familia/edit.html.twig', [
            'familium' => $familium,
            'form' => $form,
        ]);
    }

    #[Route('/{idfamilia}', name: 'app_familia_delete', methods: ['POST'])]
    public function delete(Request $request, Familia $familium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$familium->getIdfamilia(), $request->request->get('_token'))) {
            $entityManager->remove($familium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
    }
}
