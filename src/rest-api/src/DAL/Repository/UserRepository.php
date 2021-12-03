<?php

namespace App\DAL\Repository;

use App\DAL\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
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
    public function getPaginatedUsersList(
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
}
