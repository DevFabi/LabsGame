<?php


namespace App\Infrastructure\QueryBuilder;


use App\Domain\Model\Astronaut;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class AstronautQueryBuilder extends QueryBuilder
{
    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->select('astronaut')->from(Astronaut::class, 'astronaut', 'astronaut.id');
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function filterById(int $id)
    {
        $this
            ->andWhere('astronaut.id = :id')
            ->setParameter('id', $id);

        return $this;
    }
}