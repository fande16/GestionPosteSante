<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
         // Vous devez remplacer ces valeurs par des données réelles obtenues depuis votre modèle ou service
         $totalPatients = 150; // Exemple de nombre total de patients
         $todayAppointments = 10; // Exemple de nombre de rendez-vous aujourd'hui
         $upcomingAppointments = 25; // Exemple de nombre de rendez-vous à venir
 
         // Exemple de données pour les rendez-vous récents
         $recentAppointments = [
             ['patient' => 'Jean Dupont', 'motif' => 'Consultation', 'dateRdv' => new \DateTime('2024-08-04 09:00')],
             ['patient' => 'Marie Curie', 'motif' => 'Vaccination', 'dateRdv' => new \DateTime('2024-08-04 10:00')],
         ];
 
         return $this->render('home.html.twig', [
             'totalPatients' => $totalPatients,
             'todayAppointments' => $todayAppointments,
             'upcomingAppointments' => $upcomingAppointments,
             'recentAppointments' => $recentAppointments,
         ]);
    }
}
