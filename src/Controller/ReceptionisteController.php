<?php

namespace App\Controller;

use App\Entity\Receptioniste;
use App\Entity\User;
use App\Form\ReceptionisteType;
use App\Repository\ReceptionisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/receptioniste')]
class ReceptionisteController extends AbstractController
{
    private UserPasswordHasherInterface $userPasswordHasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    #[Route('/', name: 'app_receptioniste_index', methods: ['GET'])]
    public function index(ReceptionisteRepository $receptionisteRepository): Response
    {
        return $this->render('receptioniste/index.html.twig', [
            'receptionistes' => $receptionisteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_receptioniste_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $receptioniste = new Receptioniste();
        $form = $this->createForm(ReceptionisteType::class, $receptioniste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Création du compte utilisateur associé
            $user = new User();
            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());
            $roles = [$request->request->get('role')];
            $user->setRoles($roles);
            $user->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setVerified(true);
            $user->setReceptioniste($receptioniste);
            $receptioniste->setUtilisateur($user);
            $receptioniste->setUserCreate($this->getUser());
            $receptioniste->setDateCreate(new \DateTime('now'));
            $entityManager->persist($receptioniste);
            $entityManager->flush();

            return $this->redirectToRoute('app_receptioniste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('receptioniste/new.html.twig', [
            'receptioniste' => $receptioniste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_receptioniste_show', methods: ['GET'])]
    public function show(Receptioniste $receptioniste): Response
    {
        return $this->render('receptioniste/show.html.twig', [
            'receptioniste' => $receptioniste,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_receptioniste_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Receptioniste $receptioniste, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReceptionisteType::class, $receptioniste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $receptioniste->setUserUpdate($this->getUser());
            $receptioniste->setDateUpdate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_receptioniste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('receptioniste/edit.html.twig', [
            'receptioniste' => $receptioniste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_receptioniste_delete', methods: ['POST'])]
    public function delete(Request $request, Receptioniste $receptioniste, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$receptioniste->getId(), $request->getPayload()->getString('_token'))) {
            $receptioniste->setUserDelete($this->getUser());
            $receptioniste->setDateDelete(new \DateTime('now'));
            $entityManager->remove($receptioniste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_receptioniste_index', [], Response::HTTP_SEE_OTHER);
    }
}
