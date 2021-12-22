<?php

namespace App\DAL\Repository;

use App\DAL\DTO\ListPaginationParams;
use App\DAL\DTO\ListSortingParams;
use App\DAL\Entity\Article;
use App\DAL\Trait\ListPaginationTrait;
use App\DAL\Trait\ListSortingTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    use ListSortingTrait;
    use ListPaginationTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);

        $this->sortableColumns = [
            'title' => 'a.title',
            'userName' => 'u.name',
        ];
    }

    public function getArticlesList(
        ListSortingParams $sortingParams,
        ListPaginationParams $paginationParams,
        int $userId = null): array
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('a.user', 'u', Expr\Join::WITH, 'a.user = u');

        if ($userId) {
            $qb = $qb->where('a.userId = :userId')
                ->setParameter('userId', $userId);
        }

        $qb = $this->getSortedQuery($qb, $sortingParams);
        return $this->getPaginatedResults($qb, $paginationParams);
    }
}