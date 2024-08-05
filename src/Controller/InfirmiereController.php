<?php

namespace App\Controller;

use App\Entity\Infirmiere;
use App\Form\InfirmiereType;
use App\Repository\InfirmiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/infirmiere')]
class InfirmiereController extends AbstractController
{
    #[Route('/', name: 'app_infirmiere_index', methods: ['GET'])]
    public function index(InfirmiereRepository $infirmiereRepository): Response
    {
        return $this->render('infirmiere/index.html.twig', [
            'infirmieres' => $infirmiereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_infirmiere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $infirmiere = new Infirmiere();
        $form = $this->createForm(InfirmiereType::class, $infirmiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infirmiere->setUserCreate($this->getUser());
            $infirmiere->setDateCreate(new \DateTime('now'));
            $entityManager->persist($infirmiere);
            $entityManager->flush();

            return $this->redirectToRoute('app_infirmiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('infirmiere/new.html.twig', [
            'infirmiere' => $infirmiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_infirmiere_show', methods: ['GET'])]
    public function show(Infirmiere $infirmiere): Response
    {
        return $this->render('infirmiere/show.html.twig', [
            'infirmiere' => $infirmiere,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_infirmiere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Infirmiere $infirmiere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InfirmiereType::class, $infirmiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infirmiere->setUserUpdate($this->getUser());
            $infirmiere->setDateUpdate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_infirmiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('infirmiere/edit.html.twig', [
            'infirmiere' => $infirmiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_infirmiere_delete', methods: ['POST'])]
    public function delete(Request $request, Infirmiere $infirmiere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infirmiere->getId(), $request->getPayload()->getString('_token'))) {
            $infirmiere->setUserDelete($this->getUser());
            $infirmiere->setDateDelete(new \DateTime('now'));
            $entityManager->remove($infirmiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_infirmiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
