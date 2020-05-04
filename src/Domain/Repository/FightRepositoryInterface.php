<?php

namespace App\Domain\Repository;

use App\Domain\Model\Fight;

interface FightRepositoryInterface
{
    /**
     * @return Fight[]
     */
    public function findAll() : array;

    /**
     * @param Fight $fight
     */
    public function add(Fight $fight);

    /**
     * @param int $id
     *
     * @return Fight
     */
    public function findOneById(int $id) : Fight;
}