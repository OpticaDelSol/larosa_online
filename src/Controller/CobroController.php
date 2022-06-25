<?php

namespace App\Controller;

use App\Entity\Cobro;
use App\Form\CobroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cobro')]
class CobroController extends AbstractController
{
    public static function getEntityFqcn(): string
    {
        return Cobro::class;
    }

    #[Route('/', name: 'app_cobro_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cobros = $entityManager
            ->getRepository(Cobro::class)
            ->findAll();

        return $this->render('cobro/index.html.twig', [
            'cobros' => $cobros,
        ]);
    }

    #[Route('/new', name: 'app_cobro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cobro = new Cobro();
        $form = $this->createForm(CobroType::class, $cobro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cobro);
            $entityManager->flush();

            return $this->redirectToRoute('app_cobro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cobro/new.html.twig', [
            'cobro' => $cobro,
            'form' => $form,
        ]);
    }

    #[Route('/{idcobro}', name: 'app_cobro_show', methods: ['GET'])]
    public function show(Cobro $cobro): Response
    {
        return $this->render('cobro/show.html.twig', [
            'cobro' => $cobro,
        ]);
    }

    #[Route('/{idcobro}/edit', name: 'app_cobro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cobro $cobro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CobroType::class, $cobro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cobro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cobro/edit.html.twig', [
            'cobro' => $cobro,
            'form' => $form,
        ]);
    }

    #[Route('/{idcobro}', name: 'app_cobro_delete', methods: ['POST'])]
    public function delete(Request $request, Cobro $cobro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cobro->getIdcobro(), $request->request->get('_token'))) {
            $entityManager->remove($cobro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cobro_index', [], Response::HTTP_SEE_OTHER);
    }
}
