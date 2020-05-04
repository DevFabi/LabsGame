<?php

namespace App\UI\Controller;

use App\Application\Command\Fight\AskForFightCommand;
use App\Application\Query\Fight\FightListQuery;
use App\Form\FightType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;

/**
* @Rest\RouteResource(
*      "Fight",
*      pluralize=false
* )
*/
class FightController extends AbstractFOSRestController implements ClassResourceInterface
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
        $command = new AskForFightCommand();

        $form = $this->createForm(FightType::class, $command);
        $form->submit($request->request->all());

        if ($form->isValid()) {
//            $this->commandBus->handle($command);
            $this->bus->dispatch($command ,[new AmqpStamp('fight', 0)]);
        }
        if (false === $form->isValid()) {

            return $this->handleView(
                $this->view($form)
            );
        }

//        $this->bus->dispatch(new NewFight($form->getData()->getId()), [new AmqpStamp('fight', 0)]);

        return $this->handleView(
            $this->view(
                [
                    'status' => 'ok',
                ],
                Response::HTTP_CREATED
            )
        );
    }

//    public function getAction(string $id)
//    {
//        return $this->view(
//            $this->findFightById($id)
//        );
//    }
//
    public function cgetAction()
    {
        $query = new FightListQuery();

        $fightList = $this->commandBus->handle($query);

        return $this->view(
            $fightList
        );
    }
//
//    public function putAction(Request $request, string $id)
//    {
//        $existingFight = $this->findFightById($id);
//
//        $form = $this->createForm(FightType::class, $existingFight);
//
//        $form->submit($request->request->all());
//
//        if (false === $form->isValid()) {
//            return $this->view($form);
//        }
//
//        $this->entityManager->flush();
//
//        return $this->view(null, Response::HTTP_NO_CONTENT);
//    }
//
//    public function patchAction(Request $request, string $id)
//    {
//        $existingFight = $this->findFightById($id);
//
//        $form = $this->createForm(FightType::class, $existingFight);
//
//        $form->submit($request->request->all(), false);
//
//        if (false === $form->isValid()) {
//            return $this->view($form);
//        }
//
//        $this->entityManager->flush();
//
//        return $this->view(null, Response::HTTP_NO_CONTENT);
//    }
//
//    public function deleteAction(string $id)
//    {
//        $fight = $this->findFightById($id);
//
//        $this->entityManager->remove($fight);
//        $this->entityManager->flush();
//
//        return $this->view(null, Response::HTTP_NO_CONTENT);
//    }
//
//    /**
//     * @param $id
//     *
//     * @return Fight|null
//     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
//     */
//    private function findFightById($id)
//    {
//        $existingFight = $this->fightRepository->find($id);
//
//        if (null === $existingFight) {
//            throw new NotFoundHttpException();
//        }
//
//        return $existingFight;
//    }
}
