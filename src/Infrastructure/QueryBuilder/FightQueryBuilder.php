<?php


namespace App\Infrastructure\QueryBuilder;


use App\Domain\Model\Fight;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class FightQueryBuilder extends QueryBuilder
{
    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->select('fight')->from(Fight::class, 'fight', 'fight.id');
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function filterById(int $id)
    {
        $this
            ->andWhere('fight.id = :id')
            ->setParameter('id', $id);

        return $this;
    }
}
