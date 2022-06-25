<?php

namespace App\Controller;

use App\Entity\Localidad;
use App\Form\LocalidadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/localidad')]
class LocalidadController extends AbstractController
{

    public static function getEntityFqcn(): string
    {
        return Localidad::class;
    }
    #[Route('/', name: 'app_localidad_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $localidads = $entityManager
            ->getRepository(Localidad::class)
            ->findAll();

        return $this->render('localidad/index.html.twig', [
            'localidads' => $localidads,
        ]);
    }

    #[Route('/new', name: 'app_localidad_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $localidad = new Localidad();
        $form = $this->createForm(LocalidadType::class, $localidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($localidad);
            $entityManager->flush();

            return $this->redirectToRoute('app_localidad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('localidad/new.html.twig', [
            'localidad' => $localidad,
            'form' => $form,
        ]);
    }

    #[Route('/{idlocalidad}', name: 'app_localidad_show', methods: ['GET'])]
    public function show(Localidad $localidad): Response
    {
        return $this->render('localidad/show.html.twig', [
            'localidad' => $localidad,
        ]);
    }

    #[Route('/{idlocalidad}/edit', name: 'app_localidad_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Localidad $localidad, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocalidadType::class, $localidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_localidad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('localidad/edit.html.twig', [
            'localidad' => $localidad,
            'form' => $form,
        ]);
    }

    #[Route('/{idlocalidad}', name: 'app_localidad_delete', methods: ['POST'])]
    public function delete(Request $request, Localidad $localidad, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$localidad->getIdlocalidad(), $request->request->get('_token'))) {
            $entityManager->remove($localidad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_localidad_index', [], Response::HTTP_SEE_OTHER);
    }
}
