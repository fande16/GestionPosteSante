<?php

namespace App\Controller;

use App\Entity\Soins;
use App\Form\SoinsType;
use App\Repository\SoinsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/soins')]
class SoinsController extends AbstractController
{
    #[Route('/', name: 'app_soins_index', methods: ['GET'])]
    public function index(SoinsRepository $soinsRepository): Response
    {
        return $this->render('soins/index.html.twig', [
            'soins' => $soinsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_soins_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $soin = new Soins();
        $form = $this->createForm(SoinsType::class, $soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $soin->setUserCreate($this->getUser());
            $soin->setDateCreate(new \DateTime('now'));
            $entityManager->persist($soin);
            $entityManager->flush();

            return $this->redirectToRoute('app_soins_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soins/new.html.twig', [
            'soin' => $soin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_soins_show', methods: ['GET'])]
    public function show(Soins $soin): Response
    {
        return $this->render('soins/show.html.twig', [
            'soin' => $soin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_soins_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Soins $soin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoinsType::class, $soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $soin->setUserUpdate($this->getUser());
            $soin->setDateUpdate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_soins_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soins/edit.html.twig', [
            'soin' => $soin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_soins_delete', methods: ['POST'])]
    public function delete(Request $request, Soins $soin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soin->getId(), $request->getPayload()->getString('_token'))) {
            $soin->setUserDelete($this->getUser());
            $soin->setDateDelete(new \DateTime('now'));
            $entityManager->remove($soin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_soins_index', [], Response::HTTP_SEE_OTHER);
    }
}
