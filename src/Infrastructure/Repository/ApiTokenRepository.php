<?php


namespace App\Infrastructure\Repository;

use App\Domain\Model\ApiToken;
use App\Domain\Repository\ApiTokenRepositoryInterface;
use App\Infrastructure\QueryBuilder\ApiTokenQueryBuilder;

class ApiTokenRepository extends AbstractDoctrineRepository implements ApiTokenRepositoryInterface
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
    public function add(ApiToken $apiToken)
    {
        $this->entityManager->persist($apiToken);
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