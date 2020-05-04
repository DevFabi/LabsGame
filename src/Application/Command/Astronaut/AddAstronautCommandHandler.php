<?php


namespace App\Application\Command\Astronaut;


use App\Domain\Model\ApiToken;
use App\Domain\Model\Astronaut;
use App\Domain\Repository\ApiTokenRepositoryInterface;
use App\Domain\Repository\AstronautRepositoryInterface;

class AddAstronautCommandHandler
{
    private $astronautRepository;
    private $apiTokenRepository;

    public function __construct(AstronautRepositoryInterface $astronautRepository, ApiTokenRepositoryInterface $apiTokenRepository)
    {
        $this->astronautRepository = $astronautRepository;
        $this->apiTokenRepository = $apiTokenRepository;
    }

    public function handle(AddAstronautCommand $command)
    {
        $astronaut = new Astronaut($command->getUsername(),$command->getPassword());

        $apiToken = new ApiToken($astronaut);
        $this->apiTokenRepository->add($apiToken);

        $astronaut->setApiTokens([$apiToken]);
        $astronaut->setRoles(['ROLE_USER']);
        $this->astronautRepository->add($astronaut);

        return $astronaut;
    }

}