<?php

// src/Controller/DashboardController.php
// src/Controller/DashboardController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PatientRepository;
use App\Repository\RdvRepository;
use DateTime;

class DashBoardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(PatientRepository $patientRepository, RdvRepository $rendezvousRepository): Response
    {
        // Obtenir le nombre total de patients
        $totalPatients = $patientRepository->count([]);
        
        // Obtenir le nombre de rendez-vous pour la journée en cours
        $today = new DateTime();
        $today->setTime(0, 0, 0);
        $tomorrow = new DateTime();
        $tomorrow->setTime(0, 0, 0)->modify('+1 day');

        $todayAppointments = $rendezvousRepository->createQueryBuilder('r')
            ->where('r.dateRdv >= :today')
            ->andWhere('r.dateRdv < :tomorrow')
            ->setParameter('today', $today)
            ->setParameter('tomorrow', $tomorrow)
            ->getQuery()
            ->getResult();

        return $this->render('dashboard/index.html.twig', [
            'totalPatients' => $totalPatients,
            'todayAppointments' => count($todayAppointments),
            'rdvs' => $todayAppointments,
        ]);
    }
}
