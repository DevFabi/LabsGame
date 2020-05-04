<?php


namespace App\Infrastructure\QueryBuilder;


use App\Domain\Model\ApiToken;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class ApiTokenQueryBuilder extends QueryBuilder
{
    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->select('api_token')->from(ApiToken::class, 'api_token', 'api_token.id');
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function filterById(int $id)
    {
        $this
            ->andWhere('api_token.id = :id')
            ->setParameter('id', $id);

        return $this;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function filterByToken(string $token)
    {
        $this
            ->andWhere('api_token.token = :token')
            ->setParameter('token', $token);

        return $this;
    }
}