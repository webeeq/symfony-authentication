<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    private EntityManager $em;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=80)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=80,
     *     minMessage="Your name must be at least {{ limit }} characters long.",
     *     maxMessage="Your name cannot be longer than {{ limit }} characters."
     * )
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max=180,
     *     maxMessage="Your email cannot be longer than {{ limit }} characters."
     * )
     * @Assert\Email(
     *     message="The email {{ value }} is not valid."
     * )
     */
    private ?string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=8,
     *     max=50,
     *     minMessage="Your password must be at least {{ limit }} characters long.",
     *     maxMessage="Your password cannot be longer than {{ limit }} characters."
     * )
     */
    private ?string $password;

    public function __construct(EntityManager $em = null)
    {
        $this->em = $em;
    }

    /**
     * @Assert\IsFalse(message="This email is already used.")
     */
    public function isNotUserEmail(): bool
    {
        if (!empty($this->email)) {
            $userEmail = $this->em->getRepository('App:User')
                ->isUserEmail($this->email);
        }

        return !empty($this->email) && $userEmail;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): void
    {
        // Not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
