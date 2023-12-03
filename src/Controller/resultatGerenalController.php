<?php

namespace App\Controller;

use App\Entity\Quizz;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class resultatGerenalController extends AbstractController
{
        #[Route('/resultat/resultatGeneral', name: 'app_quizz_resultat')]

        public function Resultat (EntityManagerInterface $entityManager) : Response
        {
            //recuperer tous les quizz et les renvoyer
            $quizzs = $entityManager->getRepository(Quizz::class)->findAll();

            return $this->render('resultat/resultatGeneral.html.twig', [
                'quizzs' => $quizzs
                ]);
        }




}