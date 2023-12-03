<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Quizz::class, inversedBy: 'users')]
    private Collection $quizzs;

    #[ORM\ManyToMany(targetEntity: ResponseQuizz::class, inversedBy: 'users')]
    private Collection $quizzAnswers;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Quizz::class)]
    private Collection $createdQuizzs;

    public function __construct()
    {
        $this->quizzs = new ArrayCollection();
        $this->quizzAnswers = new ArrayCollection();
        $this->createdQuizzs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Quizz>
     */
    public function getQuizzs(): Collection
    {
        return $this->quizzs;
    }

    public function addQuizz(Quizz $quizz): static
    {
        if (!$this->quizzs->contains($quizz)) {
            $this->quizzs->add($quizz);
        }

        return $this;
    }

    public function removeQuizz(Quizz $quizz): static
    {
        $this->quizzs->removeElement($quizz);

        return $this;
    }

    /**
     * @return Collection<int, ResponseQuizz>
     */
    public function getQuizzAnswers(): Collection
    {
        return $this->quizzAnswers;
    }

    public function addQuizzAnswer(ResponseQuizz $quizzAnswer): static
    {
        if (!$this->quizzAnswers->contains($quizzAnswer)) {
            $this->quizzAnswers->add($quizzAnswer);
        }

        return $this;
    }

    public function removeQuizzAnswer(ResponseQuizz $quizzAnswer): static
    {
        $this->quizzAnswers->removeElement($quizzAnswer);

        return $this;
    }

    /**
     * @return Collection<int, Quizz>
     */
    public function getCreatedQuizzs(): Collection
    {
        return $this->createdQuizzs;
    }

    public function addCreatedQuizz(Quizz $createdQuizz): static
    {
        if (!$this->createdQuizzs->contains($createdQuizz)) {
            $this->createdQuizzs->add($createdQuizz);
            $createdQuizz->setAuthor($this);
        }

        return $this;
    }

    public function removeCreatedQuizz(Quizz $createdQuizz): static
    {
        if ($this->createdQuizzs->removeElement($createdQuizz)) {
            // set the owning side to null (unless already changed)
            if ($createdQuizz->getAuthor() === $this) {
                $createdQuizz->setAuthor(null);
            }
        }

        return $this;
    }
}
