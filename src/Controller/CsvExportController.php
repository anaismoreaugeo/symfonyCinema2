<?php

namespace App\Controller;

use App\Entity\Quizz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
class CsvExportController extends AbstractController
{
    #[Route('/export', name: 'app_quizz_export')]
    public function index(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $quizzRepository = $entityManager->getRepository(Quizz::class);
        $quizzList = $quizzRepository->findAll();

        $csvData = [];
        $csvData[] = ['Film', 'Credits (insérer la fonction)', 'Réponse']; // Les en-têtes du CSV

        foreach ($quizzList as $quizz) {
            foreach ($quizz->getQuestions() as $question) {
                foreach ($question->getResponseQuizzs() as $response) {
                    $csvData[] = [
                        $quizz->getTitle(),
                        $question->getTextQuestion(),
                        $response->getTextResponseQuizz()
                    ];
                }
            }
            $csvData[] = ['', '', ''];
        }

        $csvEncoder = new CsvEncoder();
        $csvContent = $serializer->encode($csvData, 'csv');
        $response = new Response($csvContent);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="quizz.csv"');

        return $response;
        return $this->render('quizz/quizzExportPreview.html.twig', [
            'response' => $response
        ]);
    }
}
