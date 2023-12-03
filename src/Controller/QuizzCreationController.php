<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Entity\User;
use App\Form\QuizzFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class QuizzCreationController extends AbstractController
{
    #[Route('/quizz/create', name: 'app_quizz_create')]
    public function QuizzForm(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $quizz = new Quizz();
        $form = $this->createForm(QuizzFormType::class, $quizz);

        $user = $this->getUser();

        if ($user instanceof User) {
            $quizz->setAuthor($user);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videoUrl = $form->get('videoPath')->getData();

            $quizz->setVideoPath($videoUrl);

            // if ($videoFile instanceof UploadedFile) {
             //   $newFilename = uniqid().'.'.$videoFile->guessExtension();

               // try {
                 //   $videoFile->move(
                   //     $this->getParameter('video_directory'),
                     //   $newFilename
             //       );
               // } catch (FileException $e) {
                    // Gérer l'exception si le déplacement du fichier échoue
                //}
                //$quizz->setVideoPath($newFilename);
           // }
            $entityManager->persist($quizz);
            $entityManager->flush();
            return $this->redirectToRoute("app_question_create", ['id' => $quizz->getId()] );
        }

        return $this->render('quizz/quizzCreation.html.twig', [
            'quizzForm' => $form->createView(),
        ]);
    }


}