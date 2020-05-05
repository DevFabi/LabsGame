<?php

namespace App\UI\Controller;

use App\Application\Command\Planet\AddPlanetCommand;
use App\Application\Query\Planet\PlanetListQuery;
use App\Form\PlanetType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

/**
* @Rest\RouteResource(
*      "Planet",
*      pluralize=false
* )
*/
class PlanetController extends AbstractFOSRestController implements ClassResourceInterface
{
    private $commandBus;

    public function __construct(
        CommandBus $commandBus
    )
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    public function postAction(Request $request)
    {
        $command = new AddPlanetCommand();

        $form = $this->createForm(PlanetType::class, $command);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $this->commandBus->handle($command);
        }

        if (false === $form->isValid()) {

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
//            $this->findPlanetById($id)
//        );
//    }
//
    public function cgetAction()
    {
        $query = new PlanetListQuery();
        $planetList = $this->commandBus->handle($query);

        return $this->view(
            $planetList
        );
    }
//
//    public function putAction(Request $request, string $id)
//    {
//        $existingPlanet = $this->findPlanetById($id);
//
//        $form = $this->createForm(PlanetType::class, $existingPlanet);
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
//        $existingPlanet = $this->findPlanetById($id);
//
//        $form = $this->createForm(PlanetType::class, $existingPlanet);
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
//        $planet = $this->findPlanetById($id);
//
//        $this->entityManager->remove($planet);
//        $this->entityManager->flush();
//
//        return $this->view(null, Response::HTTP_NO_CONTENT);
//    }
//
//    /**
//     * @param $id
//     *
//     * @return Planet|null
//     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
//     */
//    private function findPlanetById($id)
//    {
//        $existingPlanet = $this->planetRepository->find($id);
//
//        if (null === $existingPlanet) {
//            throw new NotFoundHttpException();
//        }
//
//        return $existingPlanet;
//    }

}
