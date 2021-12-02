<?php

namespace App\DAL\Repository;

use App\DAL\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use UnexpectedValueException;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private static array $sortableColumns = [
        'name' => 'u.name',
        'email' => 'u.email',
    ];

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param int $pageNumber
     * @param int $pageSize
     * @param string $sortBy
     * @param string $sortDirection
     *
     * @return User[]
     */
    public function getUsersList(
        int $pageNumber = 1,
        int $pageSize = 10,
        string $sortBy = 'name',
        string $sortDirection = Criteria::ASC): array
    {
        $sortBy = self::$sortableColumns[$sortBy];
        if (!$sortBy) throw new UnexpectedValueException("Invalid sortBy column");

        $sortDirection = strtoupper($sortDirection);
        if ($sortDirection !== Criteria::ASC && $sortDirection !== Criteria::DESC)
            throw new UnexpectedValueException("Invalid sortDirection");

        return $this->createQueryBuilder('u')
            ->orderBy($sortBy, $sortDirection)
            ->setFirstResult(($pageNumber - 1) * $pageSize)
            ->setMaxResults($pageSize)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     *
     * @return User|null
     *
     * @throws NonUniqueResultException
     */
    public function getUser(int $id): ?User
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param User $user
     *
     * @return User
     *
     * @throws ORMException
     */
    public function createUser(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->saveToDatabase();
        return $user;
    }

    /**
     * @param User $user
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteUser(User $user): void
    {
        $this->getEntityManager()->remove($user);
        $this->saveToDatabase();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveToDatabase(): void
    {
        $this->getEntityManager()->flush();
    }
}
