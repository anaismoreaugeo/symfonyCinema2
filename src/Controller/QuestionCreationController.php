<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quizz;
use App\Entity\ResponseQuizz;
use App\Form\QuestionFormType;
use App\Form\QuizzFormType;
use App\Form\QuestionResponseFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionCreationController extends AbstractController
{
    #[Route('/quizz/{id}/question', name: 'app_question_create')]
    public function QuestionForm(Request $request, Quizz $quizz, EntityManagerInterface $entityManager) : Response
    {
        $question = new Question();
        $question -> setQuizz($quizz);
        $question->setOrderQuestion($quizz->getQuestions()->count()+1);
        $form = $this->createForm(QuestionResponseFormType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($question);

            $as = $request->request->all()[$form->getName()]['responseQuizzs'];
            foreach ($as as $a) {
                $newResponses = new ResponseQuizz();
                $newResponses->setTextResponseQuizz($a["textResponseQuizz"]);
                $newResponses->setIsTrue(array_key_exists('isTrue', $a));
                $newResponses->setQuestion($question);
                $question->addResponseQuizz($newResponses);
                $entityManager->persist($question);
                $entityManager->persist($newResponses);
            }
            $entityManager->flush();
            return $this->redirectToRoute("app_quizz_doing", ['id'=>$quizz->getId()]);
        }

        return $this->render('question/QuestionResponseForm.html.twig', [
            'questionForm' => $form->createView(),
        ]);
    }

    #[Route('/quizz/{quizzId}/edit/{questionId}', name: 'app_question_edit')]
    public function QuestionEditForm(Request $request, Quizz $quizzId, Question $questionId, EntityManagerInterface $entityManager) : Response
    {
        $form = $this->createForm(QuestionResponseFormType::class, $questionId);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($questionId);

            $as = $request->request->all()[$form->getName()]['responseQuizzs'];
            foreach ($as as $a) {
                $newResponses = new ResponseQuizz();
                $newResponses->setTextResponseQuizz($a["textResponseQuizz"]);
                $newResponses->setIsTrue(array_key_exists('isTrue', $a));
                if (!in_array($newResponses, (array)$questionId->getResponseQuizzs())) {
                    $newResponses->setQuestion($questionId);
                    $questionId->addResponseQuizz($newResponses);
                    $entityManager->persist($questionId);
                    $entityManager->persist($newResponses);
                }
            }
            $entityManager->flush();
            return $this->redirectToRoute("app_quizz_doing", ['id'=>$quizzId->getId()]);
        }

        return $this->render('question/QuestionResponseForm.html.twig', [
            'questionForm' => $form->createView(),
        ]);
    }


}