<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\PlanetRepository")
 */
class Planet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id_planet")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable= true)
     */
    private $score;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Score", mappedBy="winners")
     */
    private $winner;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Score", mappedBy="loosers")
     */
    private $looser;

    /**
     * Planet constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getWinner(): Collection
    {
        return $this->winner;
    }

    public function addWinner(Score $winner): self
    {
        if (!$this->winner->contains($winner)) {
            $this->winner[] = $winner;
            $winner->addWinner($this);
        }

        return $this;
    }

    public function removeWinner(Score $winner): self
    {
        if ($this->winner->contains($winner)) {
            $this->winner->removeElement($winner);
            $winner->removeWinner($this);
        }

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getLooser(): Collection
    {
        return $this->looser;
    }

    public function addLooser(Score $looser): self
    {
        if (!$this->looser->contains($looser)) {
            $this->looser[] = $looser;
            $looser->addLooser($this);
        }

        return $this;
    }

    public function removeLooser(Score $looser): self
    {
        if ($this->looser->contains($looser)) {
            $this->looser->removeElement($looser);
            $looser->removeLooser($this);
        }

        return $this;
    }


}
