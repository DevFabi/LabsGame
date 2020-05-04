<?php


namespace App\Application\Command\Fight;


use League\Tactician\CommandBus;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AskForFightMessageHandler implements MessageHandlerInterface
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(AskForFightCommand $message)
    {
        $this->commandBus->handle($message);
    }
}