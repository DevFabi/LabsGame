<?php


namespace App\Domain\Repository;


use App\Domain\Model\Astronaut;

interface AstronautRepositoryInterface
{
    /**
     * @return Astronaut[]
     */
    public function findAll() : array;

    /**
     * @param Astronaut $astronaut
     */
    public function add(Astronaut $astronaut);

    /**
     * @param int $id
     *
     * @return Astronaut
     */
    public function findOneById(int $id) : Astronaut;
}