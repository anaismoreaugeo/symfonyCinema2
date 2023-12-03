<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $textQuestion = null;

    #[ORM\Column]
    private ?int $orderQuestion = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Quizz $quizz = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: ResponseQuizz::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $responseQuizzs;

    public function __construct()
    {
        $this->responseQuizzs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTextQuestion(): ?string
    {
        return $this->textQuestion;
    }

    public function setTextQuestion(string $textQuestion): static
    {
        $this->textQuestion = $textQuestion;

        return $this;
    }

    public function getOrderQuestion(): ?int
    {
        return $this->orderQuestion;
    }

    public function setOrderQuestion(int $orderQuestion): static
    {
        $this->orderQuestion = $orderQuestion;

        return $this;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?Quizz $quizz): static
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * @return Collection<int, ResponseQuizz>
     */
    public function getResponseQuizzs(): Collection
    {
        return $this->responseQuizzs;
    }

    public function addResponseQuizz(ResponseQuizz $responseQuizz): static
    {
        if (!$this->responseQuizzs->contains($responseQuizz)) {
            $this->responseQuizzs->add($responseQuizz);
            $responseQuizz->setQuestion($this);
        }

        return $this;
    }

    public function removeResponseQuizz(ResponseQuizz $responseQuizz): static
    {
        if ($this->responseQuizzs->removeElement($responseQuizz)) {
            // set the owning side to null (unless already changed)
            if ($responseQuizz->getQuestion() === $this) {
                $responseQuizz->setQuestion(null);
            }
        }

        return $this;
    }
}
