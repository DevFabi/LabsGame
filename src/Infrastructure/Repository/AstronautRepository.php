<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Astronaut;
use App\Domain\Repository\AstronautRepositoryInterface;
use App\Infrastructure\QueryBuilder\AstronautQueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AstronautRepository extends AbstractDoctrineRepository implements AstronautRepositoryInterface
{

    /**
     * @return AstronautQueryBuilder
     */
    private function createQueryBuilder()
    {
        return new AstronautQueryBuilder($this->entityManager);
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
    public function add(Astronaut $astronaut)
    {
        $this->entityManager->persist($astronaut);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(int $id): Astronaut
    {
        return $this
            ->createQueryBuilder()
            ->filterById($id)
            ->getQuery()
            ->getSingleResult();
    }


    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof Astronaut) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }
}
