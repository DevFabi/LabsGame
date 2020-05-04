<?php


namespace App\UI\Controller;


use App\Application\Command\Astronaut\AddAstronautCommand;
use App\Form\AddAstronautType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @Rest\RouteResource(
 *      "Astronaut",
 *      pluralize=false
 * )
 */

class AstronautController extends AbstractFOSRestController implements ClassResourceInterface
{
    private $commandBus;
    private $bus;

    public function __construct(
        CommandBus $commandBus,
        MessageBusInterface $bus
    )
    {
        $this->commandBus = $commandBus;
        $this->bus = $bus;
    }

    public function postAction(Request $request)
    {
        $command = new AddAstronautCommand();

        $form = $this->createForm(AddAstronautType::class, $command);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $this->commandBus->handle($command);
        }

        return $this->handleView(
            $this->view(
                [
                    'status' => 'ok',
                ],
                Response::HTTP_CREATED
            )
        );
    }
}