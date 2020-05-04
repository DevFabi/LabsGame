<?php

namespace App\Application\Query\Fight;

use App\Domain\Repository\FightRepositoryInterface;

class FightListQueryHandler
{

    private $fightRepository;

    public function __construct(FightRepositoryInterface $fightRepository)
    {
        $this->fightRepository = $fightRepository;
    }

    public function handle(FightListQuery $query)
    {
        return $this->fightRepository->findAll();
    }

}