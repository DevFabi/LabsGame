<?php

namespace App\Domain\Repository;

use App\Domain\Model\Score;

interface ScoreRepositoryInterface
{
    /**
     * @return Score[]
     */
    public function findAll() : array;

    /**
     * @param Score $score
     *
     */
    public function add(Score $score);

    /**
     * @param int $id
     *
     * @return Score
     */
    public function findOneById(int $id) : Score;

}