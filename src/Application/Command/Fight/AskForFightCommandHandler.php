<?php


namespace App\Application\Command\Fight;

use App\Domain\Repository\FightRepositoryInterface;
use App\Domain\Model\Fight;
use App\Domain\Repository\PlanetRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AskForFightCommandHandler
{
    public function handle(AskForFightCommand $command)
    {
        $fight = new Fight(
            null,
            null,
            $command->amountGain,
            $command->amountLoss,
            $command->date,
            $command->rules
        );
        foreach ($command->firstOpponents as $firstOpponent)
        {
            $fight->addFirstOpponent($this->planetRepository->findOneById($firstOpponent));
        }
        foreach ($command->secondOpponents as $secondOpponent)
        {
            $fight->addSecondOpponent($this->planetRepository->findOneById($secondOpponent));
        }

        $this->fightRepository->add($fight);
        return $fight;
    }

    public function __construct(FightRepositoryInterface $fightRepository, PlanetRepositoryInterface $planetRepository)
    {
        $this->fightRepository = $fightRepository;
        $this->planetRepository = $planetRepository;
    }

    private $fightRepository;
    private $planetRepository;
}