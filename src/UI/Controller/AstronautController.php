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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    private $userPasswordEncoder;

    public function __construct(
        CommandBus $commandBus,
        MessageBusInterface $bus,
    UserPasswordEncoderInterface $userPasswordEncoder
    )
    {
        $this->commandBus = $commandBus;
        $this->bus = $bus;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }


    public function postAction(Request $request)
    {
        $command = new AddAstronautCommand(null, null, $this->userPasswordEncoder);

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