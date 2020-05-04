<?php

namespace App\Application\Query\Planet;

use App\Domain\Repository\PlanetRepositoryInterface;

class PlanetListQueryHandler
{

    private $planetRepository;

    public function __construct(PlanetRepositoryInterface $planetRepository)
    {
        $this->planetRepository = $planetRepository;
    }

    public function handle(PlanetListQuery $query)
    {
        return $this->planetRepository->findAll();
    }
}