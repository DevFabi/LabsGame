<?php

namespace App\UI\Controller;

use App\Application\Command\Score\WriteScoreFightCommand;
use App\Form\ScoreType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;

/**
* @Rest\RouteResource(
*      "Score",
*      pluralize=false
* )
*/
class ScoreController extends AbstractFOSRestController implements ClassResourceInterface
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

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    public function postAction(Request $request)
    {
        $command = new WriteScoreFightCommand();

        $form = $this->createForm(ScoreType::class, $command);

        $form->submit($request->request->all());

        if ($form->isValid()) {
//            $this->commandBus->handle($command);
            $this->bus->dispatch($command,[new AmqpStamp('score', 0)]);

        }else {
            return $this->handleView(
                $this->view($form)
            );
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

//    public function getAction(string $id)
//    {
//        return $this->view(
//            $this->findScoreById($id)
//        );
//    }
//
//    public function cgetAction()
//    {
//        return $this->view(
//            $this->scoreRepository->findAll()
//        );
//    }
//
//    public function putAction(Request $request, string $id)
//    {
//        $existingScore = $this->findScoreById($id);
//
//        $form = $this->createForm(ScoreType::class, $existingScore);
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
//        $existingScore = $this->findScoreById($id);
//
//        $form = $this->createForm(ScoreType::class, $existingScore);
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
//        $score = $this->findScoreById($id);
//
//        $this->entityManager->remove($score);
//        $this->entityManager->flush();
//
//        return $this->view(null, Response::HTTP_NO_CONTENT);
//    }
//
//    /**
//     * @param $id
//     *
//     * @return Score|null
//     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
//     */
//    private function findScoreById($id)
//    {
//        $existingScore = $this->scoreRepository->find($id);
//
//        if (null === $existingScore) {
//            throw new NotFoundHttpException();
//        }
//
//        return $existingScore;
//    }
}
