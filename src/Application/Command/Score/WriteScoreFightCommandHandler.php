<?php


namespace App\Application\Command\Score;


use App\Domain\Model\Score;
use App\Domain\Repository\FightRepositoryInterface;
use App\Domain\Repository\PlanetRepositoryInterface;
use App\Domain\Repository\ScoreRepositoryInterface;

class WriteScoreFightCommandHandler
{
    private $scoreRepository;
    private $planetRepository;
    private $fightRepository;

    public function __construct(ScoreRepositoryInterface $scoreRepository, PlanetRepositoryInterface $planetRepository, FightRepositoryInterface $fightRepository)
    {
        $this->scoreRepository = $scoreRepository;
        $this->planetRepository = $planetRepository;
        $this->fightRepository = $fightRepository;
    }

    public function handle(WriteScoreFightCommand $command)
    {
        $score = new Score(null, $command->endDateTime, null, null);

        $fight = $this->fightRepository->findOneById($command->fight);
        $loosersPoints = $fight->getLoosersPoints();
        $winnersPoints = $fight->getWinnersPoints();

        $score->setFight($fight);

        foreach ($command->loosers as $looser) {
            $looserObject = $this->planetRepository->findOneById($looser);

            if ($looserObject->getScore() >= $loosersPoints){
                $looserObject->setScore(
                    $looserObject->getScore() - $loosersPoints
                );
            } else {
                $looserObject->setScore(0);
            }

            $score->addLooser($looserObject);
        }
        foreach ($command->winners as $winner) {
            $winnerObject = $this->planetRepository->findOneById($winner);
            $winnerObject->setScore($winnerObject->getScore() + $winnersPoints);
            $score->addWinner($winnerObject);
        }

        $this->scoreRepository->add($score);

        return $score;
    }

}