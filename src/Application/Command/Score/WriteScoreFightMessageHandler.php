<?php

namespace App\Application\Command\Score;

use League\Tactician\CommandBus;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class WriteScoreFightMessageHandler implements MessageHandlerInterface
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(WriteScoreFightCommand $message)
    {
        $this->commandBus->handle($message);
    }
}