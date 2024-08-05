<?php

namespace App\Controller;

use App\Entity\ModePaiement;
use App\Form\ModePaiementType;
use App\Repository\ModePaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mode/paiement')]
class ModePaiementController extends AbstractController
{
    #[Route('/', name: 'app_mode_paiement_index', methods: ['GET'])]
    public function index(ModePaiementRepository $modePaiementRepository): Response
    {
        return $this->render('mode_paiement/index.html.twig', [
            'mode_paiements' => $modePaiementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mode_paiement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $modePaiement = new ModePaiement();
        $form = $this->createForm(ModePaiementType::class, $modePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modePaiement->setUserCreate($this->getUser());
            $modePaiement->setDateCreate(new \DateTime('now'));
            $entityManager->persist($modePaiement);
            $entityManager->flush();

            return $this->redirectToRoute('app_mode_paiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mode_paiement/new.html.twig', [
            'mode_paiement' => $modePaiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mode_paiement_show', methods: ['GET'])]
    public function show(ModePaiement $modePaiement): Response
    {
        return $this->render('mode_paiement/show.html.twig', [
            'mode_paiement' => $modePaiement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mode_paiement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ModePaiement $modePaiement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModePaiementType::class, $modePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modePaiement->setUserUpdate($this->getUser());
            $modePaiement->setDateUpdate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_mode_paiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mode_paiement/edit.html.twig', [
            'mode_paiement' => $modePaiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mode_paiement_delete', methods: ['POST'])]
    public function delete(Request $request, ModePaiement $modePaiement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modePaiement->getId(), $request->getPayload()->getString('_token'))) {
            $modePaiement->setUserDelete($this->getUser());
            $modePaiement->setDateDelete(new \DateTime('now'));
            $entityManager->remove($modePaiement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mode_paiement_index', [], Response::HTTP_SEE_OTHER);
    }
}
