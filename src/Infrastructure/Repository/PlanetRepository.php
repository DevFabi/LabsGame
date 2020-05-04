<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Planet;
use App\Domain\Repository\PlanetRepositoryInterface;
use App\Infrastructure\QueryBuilder\PlanetQueryBuilder;

class PlanetRepository extends AbstractDoctrineRepository implements PlanetRepositoryInterface
{
    /**
     * @return PlanetQueryBuilder
     */
    private function createQueryBuilder()
    {
        return new PlanetQueryBuilder($this->entityManager);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this
            ->createQueryBuilder()
            ->getQuery()
            ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function add(Planet $planet)
    {
        $this->entityManager->persist($planet);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(int $id): Planet
    {
        return $this
            ->createQueryBuilder()
            ->filterById($id)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getListItems() : array
    {
        return $this
            ->createQueryBuilder()
            ->selectListItem()
            ->getQuery()
            ->getResult();
    }

}
