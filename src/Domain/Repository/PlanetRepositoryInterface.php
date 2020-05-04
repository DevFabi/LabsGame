<?php


namespace App\Domain\Repository;


use App\Domain\Model\Planet;

interface PlanetRepositoryInterface
{
    /**
     * @return Planet[]
     */
    public function findAll() : array;

    /**
     * @param Planet $planet
     */
    public function add(Planet $planet);

    /**
     * @param int $id
     *
     * @return Planet
     */
    public function findOneById(int $id) : Planet;

}