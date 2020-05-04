<?php


namespace App\Application\Command\Planet;


use App\Domain\Model\Planet;
use App\Domain\Repository\PlanetRepositoryInterface;

class AddPlanetCommandHandler
{
    /**
     * @var PlanetRepositoryInterface
     */
    private $planetRepository;

    public function __construct(PlanetRepositoryInterface $planetRepository)
    {
        $this->planetRepository = $planetRepository;
    }

    public function handle(AddPlanetCommand $command)
    {
        $planet = new Planet($command->name);

        $this->planetRepository->add($planet);

        return $planet;
    }
}
