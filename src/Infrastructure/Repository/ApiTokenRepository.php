<?php


namespace App\Infrastructure\Repository;

use App\Domain\Model\ApiToken;
use App\Domain\Model\Fight;
use App\Infrastructure\QueryBuilder\ApiTokenQueryBuilder;
use Doctrine\ORM\EntityRepository;

class ApiTokenRepository extends AbstractDoctrineRepository
{
    /**
     * @return ApiTokenQueryBuilder()
     */
    private function createQueryBuilder()
    {
        return new ApiTokenQueryBuilder($this->entityManager);
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
    public function findOneById(int $id): ApiToken
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
    public function findOneByToken(string $token): ApiToken
    {
        return $this
            ->createQueryBuilder()
            ->filterByToken($token)
            ->getQuery()
            ->getSingleResult();
    }
}