<?php

namespace App\Controller;

use App\Entity\Laboratin;
use App\Entity\User;
use App\Form\LaboratinType;
use App\Repository\LaboratinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/laboratin')]
class LaboratinController extends AbstractController
{
    private UserPasswordHasherInterface $userPasswordHasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    #[Route('/', name: 'app_laboratin_index', methods: ['GET'])]
    public function index(LaboratinRepository $laboratinRepository): Response
    {
        return $this->render('laboratin/index.html.twig', [
            'laboratins' => $laboratinRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_laboratin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $laboratin = new Laboratin();
        $form = $this->createForm(LaboratinType::class, $laboratin);
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
             $user->setLaboratin($laboratin);
             $laboratin->setUtilisateur($user);
            $laboratin->setUserCreate($this->getUser());
            $laboratin->setDateCreate(new \DateTime('now'));
            $entityManager->persist($laboratin);
            $entityManager->flush();

            return $this->redirectToRoute('app_laboratin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('laboratin/new.html.twig', [
            'laboratin' => $laboratin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_laboratin_show', methods: ['GET'])]
    public function show(Laboratin $laboratin): Response
    {
        return $this->render('laboratin/show.html.twig', [
            'laboratin' => $laboratin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_laboratin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Laboratin $laboratin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LaboratinType::class, $laboratin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $laboratin->setUserUpdate($this->getUser());
            $laboratin->setDateUpdate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_laboratin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('laboratin/edit.html.twig', [
            'laboratin' => $laboratin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_laboratin_delete', methods: ['POST'])]
    public function delete(Request $request, Laboratin $laboratin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$laboratin->getId(), $request->getPayload()->getString('_token'))) {
            $laboratin->setUserDelete($this->getUser());
            $laboratin->setDateDelete(new \DateTime('now'));
            $entityManager->remove($laboratin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_laboratin_index', [], Response::HTTP_SEE_OTHER);
    }
}
