<?php


namespace App\Infrastructure\QueryBuilder;


use App\Domain\Model\Score;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class ScoreQueryBuilder extends QueryBuilder
{

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->select('score')->from(Score::class, 'score', 'score.id');
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function filterById(int $id)
    {
        $this
            ->andWhere('score.id = :id')
            ->setParameter('id', $id);

        return $this;
    }
}