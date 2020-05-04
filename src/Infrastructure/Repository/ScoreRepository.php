<?php


namespace App\Infrastructure\Repository;


use App\Domain\Model\Score;
use App\Domain\Repository\ScoreRepositoryInterface;
use App\Infrastructure\QueryBuilder\ScoreQueryBuilder;

class ScoreRepository extends AbstractDoctrineRepository implements ScoreRepositoryInterface
{
    /**
     * @return ScoreQueryBuilder
     */
    private function createQueryBuilder()
    {
        return new ScoreQueryBuilder($this->entityManager);
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
    public function add(Score $score)
    {
        $this->entityManager->persist($score);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(int $id): Score
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