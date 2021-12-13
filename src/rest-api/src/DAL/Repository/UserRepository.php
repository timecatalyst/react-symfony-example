<?php

namespace App\DAL\Repository;

use App\DAL\DTO\ListPaginationParams;
use App\DAL\DTO\ListSortingParams;
use App\DAL\Entity\User;
use App\DAL\Trait\ListPaginationTrait;
use App\DAL\Trait\ListSortingTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    use ListSortingTrait;
    use ListPaginationTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);

        $this->sortableColumns = [
            'name' => 'u.name',
            'email' => 'u.email',
        ];
    }

    /**
     * @param ListSortingParams $sortingParams
     * @param ListPaginationParams $paginationParams
     *
     * @return User[]
     */
    public function getUsersList(
        ListSortingParams $sortingParams,
        ListPaginationParams $paginationParams): array
    {
        $qb = $this->createQueryBuilder('u');
        $qb = $this->getSortedQuery($qb, $sortingParams);
        return $this->getPaginatedResults($qb, $paginationParams);
    }
}
