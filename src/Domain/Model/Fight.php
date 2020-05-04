<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Fight
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id_fight")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Planet")
     * @ORM\JoinTable(name="fight_planet_first_opponents",
     *      joinColumns={@ORM\JoinColumn(name="fight_id", referencedColumnName="id_fight")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="first_opponents_id", referencedColumnName="id_planet")}
     *      )
     */
    private $firstOpponents;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Planet")
     * @ORM\JoinTable(name="fight_planet_second_opponents",
     *      joinColumns={@ORM\JoinColumn(name="fight_id", referencedColumnName="id_fight")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="second_opponents_id", referencedColumnName="id_planet")}
     *      )
     */
    private $secondOpponents;

    /**
     * @ORM\Column(type="integer")
     */
    private $winnersPoints;

    /**
     * @ORM\Column(type="integer")
     */
    private $loosersPoints;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rules;


    /**
     * @ORM\OneToOne(targetEntity="App\Domain\Model\Score", mappedBy="fight", cascade={"persist", "remove"})
     */
    private $score;

    /**
     * Fight constructor.
     * @param $id
     * @param $firstOpponents
     * @param $secondOpponents
     * @param $winnersPoints
     * @param $loosersPoints
     * @param $date
     * @param $rules
     * @param $score
     */
    public function __construct($firstOpponents, $secondOpponents, $winnersPoints, $loosersPoints, $date, $rules, $score = null)
    {
        $this->firstOpponents = new ArrayCollection();
        $this->secondOpponents = new ArrayCollection();
        $this->winnersPoints = $winnersPoints;
        $this->loosersPoints = $loosersPoints;
        $this->date = $date;
        $this->rules = $rules;
        $this->score = $score;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Planet[]
     */
    public function getFirstOpponents(): Collection
    {
        return $this->firstOpponents;
    }

    public function addFirstOpponent(Planet $firstOpponent): self
    {
        if (!$this->firstOpponents->contains($firstOpponent)) {
            $this->firstOpponents[] = $firstOpponent;
        }

        return $this;
    }

    public function removeFirstOpponent(Planet $firstOpponent): self
    {
        if ($this->firstOpponents->contains($firstOpponent)) {
            $this->firstOpponents->removeElement($firstOpponent);
        }

        return $this;
    }

    /**
     * @return Collection|Planet[]
     */
    public function getSecondOpponents(): Collection
    {
        return $this->secondOpponents;
    }

    public function addSecondOpponent(Planet $secondOpponent): self
    {
        if (!$this->secondOpponents->contains($secondOpponent)) {
            $this->secondOpponents[] = $secondOpponent;
        }

        return $this;
    }

    public function removeSecondOpponent(Planet $secondOpponent): self
    {
        if ($this->secondOpponents->contains($secondOpponent)) {
            $this->secondOpponents->removeElement($secondOpponent);
        }

        return $this;
    }

    public function getWinnersPoints(): ?int
    {
        return $this->winnersPoints;
    }

    public function setWinnersPoints(int $winnersPoints): self
    {
        $this->winnersPoints = $winnersPoints;

        return $this;
    }

    public function getLoosersPoints(): ?int
    {
        return $this->loosersPoints;
    }

    public function setLoosersPoints(int $loosersPoints): self
    {
        $this->loosersPoints = $loosersPoints;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRules(): ?string
    {
        return $this->rules;
    }

    public function setRules(?string $rules): self
    {
        $this->rules = $rules;

        return $this;
    }


    public function getScore(): ?Score
    {
        return $this->score;
    }

    public function setScore(Score $score): self
    {
        $this->score = $score;

        // set the owning side of the relation if necessary
        if ($score->getFight() !== $this) {
            $score->setFight($this);
        }

        return $this;
    }
}
