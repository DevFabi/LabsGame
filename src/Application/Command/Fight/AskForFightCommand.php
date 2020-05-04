<?php


namespace App\Application\Command\Fight;

use Doctrine\Common\Collections\ArrayCollection;

class AskForFightCommand
{
    /**
     * @var string
     */
    public $rules;

    public $amountGain;
    public $amountLoss;

    public $firstOpponents;
    public $secondOpponents;

    public $date;

    public function __construct(string $rules = null, $amountGain = null, $amountLoss = null, $firstOpponents = null, $secondOpponents = null, $date = null)
    {
        $this->rules = $rules;
        $this->firstOpponents = $firstOpponents;
        $this->secondOpponents = $secondOpponents;
        $this->amountGain= $amountGain;
        $this->amountLoss = $amountLoss;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getRules(): ?string
    {
        return $this->rules;
    }

    /**
     * @return null
     */
    public function getAmountGain()
    {
        return $this->amountGain;
    }

    /**
     * @return null
     */
    public function getAmountLoss()
    {
        return $this->amountLoss;
    }

    /**
     * @return null
     */
    public function getFirstOpponents()
    {
        return $this->firstOpponents;
    }

    /**
     * @return null
     */
    public function getSecondOpponents()
    {
        return $this->secondOpponents;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }


}