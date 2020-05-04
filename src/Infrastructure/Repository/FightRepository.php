<?php


namespace App\Infrastructure\Repository;

use App\Domain\Model\Fight;
use App\Domain\Repository\FightRepositoryInterface;
use App\Infrastructure\QueryBuilder\FightQueryBuilder;

class FightRepository extends AbstractDoctrineRepository implements FightRepositoryInterface
{
    /**
     * @return FightQueryBuilder
     */
    private function createQueryBuilder()
    {
        return new FightQueryBuilder($this->entityManager);
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
    public function add(Fight $fight)
    {
        $this->entityManager->persist($fight);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(int $id): Fight
    {
        return $this
            ->createQueryBuilder()
            ->filterById($id)
            ->getQuery()
            ->getSingleResult();
    }

}
