<?php

namespace App\Controller;

use App\Entity\PriseService;
use App\Form\PriseServiceType;
use App\Repository\PriseServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/prise/service')]
class PriseServiceController extends AbstractController
{
    #[Route('/', name: 'app_prise_service_index', methods: ['GET'])]
    public function index(PriseServiceRepository $priseServiceRepository): Response
    {
        return $this->render('prise_service/index.html.twig', [
            'prise_services' => $priseServiceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_prise_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $priseService = new PriseService();
        $form = $this->createForm(PriseServiceType::class, $priseService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $priseService->setUserCreate($this->getUser());
            $priseService->setDateDebut(new \DateTime('now'));
            $priseService->setUtilisateur($this->getUser());
            //$priseService->setDateFin(new \DateTime('logout'));

            $priseService->setDateCreate(new \DateTime('now'));
            $entityManager->persist($priseService);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prise_service/new.html.twig', [
            'prise_service' => $priseService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prise_service_show', methods: ['GET'])]
    public function show(PriseService $priseService): Response
    {
        return $this->render('prise_service/show.html.twig', [
            'prise_service' => $priseService,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_prise_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PriseService $priseService, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PriseServiceType::class, $priseService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $priseService->setUserUpdate($this->getUser());
            $priseService->setDateUpdate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_prise_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prise_service/edit.html.twig', [
            'prise_service' => $priseService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prise_service_delete', methods: ['POST'])]
    public function delete(Request $request, PriseService $priseService, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$priseService->getId(), $request->getPayload()->getString('_token'))) {
            $priseService->setUserDelete($this->getUser());
            $priseService->setDateDelete(new \DateTime('now'));
            $entityManager->remove($priseService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_prise_service_index', [], Response::HTTP_SEE_OTHER);
    }#[Route('/setfindeservice', name: 'app_set_findeservice')]
    public function setFinDeService(PriseServiceRepository $priseServiceRepository): Response
    {
        $user = $this->getUser();
        if ($user) {
            $priseservice = $priseServiceRepository->findOneBy(['user' => $user, 'fin' => null]);
            if ($priseservice) {
                $priseservice->setFinDeService(new \DateTime('now'));
                $priseServiceRepository->save($priseservice, true);
            }
        }
        return new Response('Service updated');
    }
}
