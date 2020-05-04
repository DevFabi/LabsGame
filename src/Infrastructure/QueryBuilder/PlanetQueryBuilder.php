<?php

namespace App\Infrastructure\QueryBuilder;

use App\Domain\Model\Planet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class PlanetQueryBuilder extends QueryBuilder
{
    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->select('planet')->from(Planet::class, 'planet', 'planet.id');
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function filterById(int $id)
    {
        $this
            ->andWhere('planet.id = :id')
            ->setParameter('id', $id);

        return $this;
    }
}
