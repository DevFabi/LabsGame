<?php


namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\ApiTokenRepository")
 */

class ApiToken
{
    public function __construct(Astronaut $astronaut)
    {
        $this->token = bin2hex(random_bytes(60));
        $this->astronaut = $astronaut;
        $this->expiresAt = new \DateTime('+10 days');
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;
    /**
     * @ORM\Column(type="datetime")
     */
    private $expiresAt;
    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Astronaut", inversedBy="apiTokens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $astronaut;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getToken(): ?string
    {
        return $this->token;
    }
//    public function setToken(string $token): self
//    {
//        $this->token = $token;
//        return $this;
//    }
    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }
//    public function setExpiresAt(\DateTimeInterface $expiresAt): self
//    {
//        $this->expiresAt = $expiresAt;
//        return $this;
//    }
    public function getAstronaut(): ?Astronaut
    {
        return $this->astronaut;
    }
//    public function setAstronaut(?Astronaut $astronaut): self
//    {
//        $this->astronaut = $astronaut;
//        return $this;
//    }

    public function renewExpiresAt()
    {
        $this->expiresAt = new \DateTime('+10 days');
    }

    public function isExpired(): bool
    {
        return $this->getExpiresAt() <= new \DateTime();
    }
}