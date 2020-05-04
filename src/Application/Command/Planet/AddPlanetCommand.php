<?php


namespace App\Application\Command\Planet;


class AddPlanetCommand
{
    /**
     * @var string
     */
    public $name;

    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

}