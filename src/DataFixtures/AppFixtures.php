<?php

namespace App\DataFixtures;


use App\Entity\Question;
use App\Entity\Quizz;
use App\Entity\ResponseQuizz;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $quizz = new Quizz();
            $quizz->setTitle('Title '.$i);
            for ($j = 0; $j < 5; $j++) {
                $question = new Question();
                $question->setOrderQuestion($j+1);
                $question->setTextQuestion('Question '.$j);
                $manager->persist($question);
                for ($k = 0; $k < 5; $k++) {
                    $responseQuestion = new ResponseQuizz();
                    $responseQuestion->setIsTrue(false);
                    $responseQuestion->setTextResponseQuizz("Response".$k);
                    $manager->persist($responseQuestion);

                    $question->addResponseQuizz($responseQuestion);
                }
                $quizz->addQuestion($question);
            }
            $manager->persist($quizz);
        }

        $manager->flush();
    }
}