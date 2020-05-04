<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Score
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Domain\Model\Fight", inversedBy="score", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, name="fight_id", referencedColumnName="id_fight")
     */
    private $fight;

    /**
     * @ORM\Column(type="date")
     */
    private $endDateTime;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Planet", inversedBy="winner")
     * @ORM\JoinTable(name="score_planet_winners",
     *      joinColumns={@ORM\JoinColumn(name="score_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="winner_id", referencedColumnName="id_planet")}
     *      )
     */
    private $winners;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Planet", inversedBy="looser")
     * @ORM\JoinTable(name="score_planet_loosers",
     *      joinColumns={@ORM\JoinColumn(name="score_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="looser_id", referencedColumnName="id_planet")}
     *      )
     */
    private $loosers;

    /**
     * Score constructor.
     * @param $fight
     * @param $endDateTime
     * @param $winners
     * @param $loosers
     */
    public function __construct($fight, $endDateTime, $winners, $loosers)
    {
        $this->fight = $fight;
        $this->endDateTime = $endDateTime;
        $this->winners = new ArrayCollection();
        $this->loosers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFight(): ?Fight
    {
        return $this->fight;
    }

    public function setFight(Fight $fight): self
    {
        $this->fight = $fight;

        return $this;
    }

    public function getEndDateTime(): ?\DateTimeInterface
    {
        return $this->endDateTime;
    }

    public function setEndDateTime(\DateTimeInterface $endDateTime): self
    {
        $this->endDateTime = $endDateTime;

        return $this;
    }

    /**
     * @return Collection|Planet[]
     */
    public function getWinners(): Collection
    {
        return $this->winners;
    }

    public function addWinner(Planet $winner): self
    {
        if (!$this->winners->contains($winner)) {
            $this->winners[] = $winner;
        }

        return $this;
    }

    public function removeWinner(Planet $winner): self
    {
        if ($this->winners->contains($winner)) {
            $this->winners->removeElement($winner);
        }

        return $this;
    }

    /**
     * @return Collection|Planet[]
     */
    public function getLoosers(): Collection
    {
        return $this->loosers;
    }

    public function addLooser(Planet $looser): self
    {
        if (!$this->loosers->contains($looser)) {
            $this->loosers[] = $looser;
        }

        return $this;
    }

    public function removeLooser(Planet $looser): self
    {
        if ($this->loosers->contains($looser)) {
            $this->loosers->removeElement($looser);
        }

        return $this;
    }

}
