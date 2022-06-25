<?php

namespace App\Controller;

use App\Entity\Grupo;
use App\Form\GrupoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/grupo')]
class GrupoController extends AbstractController
{
    public static function getEntityFqcn(): string
    {
        return Grupo::class;
    }

    #[Route('/', name: 'app_grupo_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $grupos = $entityManager
            ->getRepository(Grupo::class)
            ->findAll();

        return $this->render('grupo/index.html.twig', [
            'grupos' => $grupos,
        ]);
    }

    #[Route('/new', name: 'app_grupo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $grupo = new Grupo();
        $form = $this->createForm(GrupoType::class, $grupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($grupo);
            $entityManager->flush();

            return $this->redirectToRoute('app_grupo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('grupo/new.html.twig', [
            'grupo' => $grupo,
            'form' => $form,
        ]);
    }

    #[Route('/{idgrupo}', name: 'app_grupo_show', methods: ['GET'])]
    public function show(Grupo $grupo): Response
    {
        return $this->render('grupo/show.html.twig', [
            'grupo' => $grupo,
        ]);
    }

    #[Route('/{idgrupo}/edit', name: 'app_grupo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Grupo $grupo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GrupoType::class, $grupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_grupo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('grupo/edit.html.twig', [
            'grupo' => $grupo,
            'form' => $form,
        ]);
    }

    #[Route('/{idgrupo}', name: 'app_grupo_delete', methods: ['POST'])]
    public function delete(Request $request, Grupo $grupo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grupo->getIdgrupo(), $request->request->get('_token'))) {
            $entityManager->remove($grupo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_grupo_index', [], Response::HTTP_SEE_OTHER);
    }
}
