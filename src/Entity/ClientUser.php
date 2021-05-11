<?php

namespace App\Entity;

use App\Repository\ClientUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientUserRepository::class)
 * @UniqueEntity(
 *  fields={"email"},
 *  message="Cette adresse email est déjà utilisée !"
 * )
 */
class ClientUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="clientUsers")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Groups({"client:read", "user:read"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Groups({"client:read", "user:read"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Email(message="Cette adresse email n'est pas valide !")
     * @Groups({"client:read", "user:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Groups({"client:read"})
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"client:read", "user:read"})
     */
    private $ref;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"client:read", "user:read"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
