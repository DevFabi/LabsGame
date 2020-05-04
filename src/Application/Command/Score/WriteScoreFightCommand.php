<?php


namespace App\Application\Command\Score;


class WriteScoreFightCommand
{
    public $fight;
    public $endDateTime;
    public $winners;
    public $loosers;

    public function __construct($fight = null, $endDateTime = null, $winners = null, $loosers = null)
    {
        $this->fight = $fight;
        $this->endDateTime = $endDateTime;
        $this->winners = $winners;
        $this->loosers = $loosers;
    }

    /**
     * @return null
     */
    public function getFight()
    {
        return $this->fight;
    }

    /**
     * @return null
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * @return null
     */
    public function getWinners()
    {
        return $this->winners;
    }

    /**
     * @return null
     */
    public function getLoosers()
    {
        return $this->loosers;
    }


}