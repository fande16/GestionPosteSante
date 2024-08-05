<?php

namespace App\Controller;

use App\Entity\Pharmacien;
use App\Entity\User;
use App\Form\PharmacienType;
use App\Repository\PharmacienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pharmacien')]
class PharmacienController extends AbstractController
{
    private UserPasswordHasherInterface $userPasswordHasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    #[Route('/', name: 'app_pharmacien_index', methods: ['GET'])]
    public function index(PharmacienRepository $pharmacienRepository): Response
    {
        return $this->render('pharmacien/index.html.twig', [
            'pharmaciens' => $pharmacienRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pharmacien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pharmacien = new Pharmacien();
        $form = $this->createForm(PharmacienType::class, $pharmacien);
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
             $user->setPharmacien($pharmacien);
             $pharmacien->setUtilisateur($user);
 
            $pharmacien->setUserCreate($this->getUser());
            $pharmacien->setDateCreate(new \DateTime('now'));
            $entityManager->persist($pharmacien);
            $entityManager->flush();

            return $this->redirectToRoute('app_pharmacien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pharmacien/new.html.twig', [
            'pharmacien' => $pharmacien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pharmacien_show', methods: ['GET'])]
    public function show(Pharmacien $pharmacien): Response
    {
        return $this->render('pharmacien/show.html.twig', [
            'pharmacien' => $pharmacien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pharmacien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pharmacien $pharmacien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PharmacienType::class, $pharmacien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pharmacien->setUserUpdate($this->getUser());
            $pharmacien->setDateUpdate(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('app_pharmacien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pharmacien/edit.html.twig', [
            'pharmacien' => $pharmacien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pharmacien_delete', methods: ['POST'])]
    public function delete(Request $request, Pharmacien $pharmacien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharmacien->getId(), $request->getPayload()->getString('_token'))) {
            $pharmacien->setUserDelete($this->getUser());
            $pharmacien->setDateDelete(new \DateTime('now'));
            $entityManager->remove($pharmacien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pharmacien_index', [], Response::HTTP_SEE_OTHER);
    }
}
