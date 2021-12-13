<?php

namespace App\DAL\Trait;

use App\DAL\DTO\ListPaginationParams;
use Doctrine\ORM\QueryBuilder;
use UnexpectedValueException;

trait ListPaginationTrait
{
    private array $sortableColumns = [];

    /**
     * An internal method used to validate the pagination parameters before
     * attempting to construct and execute a query.
     *
     * @param ListPaginationParams $params
     */
    private function validatePaginationParams(ListPaginationParams $params)
    {
        if ($params->getPageNumber() < 0)
            throw new UnexpectedValueException("pageNumber cannot be negative");

        if ($params->getPageSize() < 0)
            throw new UnexpectedValueException("pageSize cannot be negative");
    }

    /**
     * Adds pagination to a given query builder object.
     *
     * @param QueryBuilder $qb
     * @param ListPaginationParams $params
     *
     * @return QueryBuilder
     */
    private function getPaginatedQuery(QueryBuilder $qb, ListPaginationParams $params): QueryBuilder
    {
        $this->validatePaginationParams($params);

        $pageSize = $params->getPageSize();

        return $qb
            ->setFirstResult(($params->getPageNumber() - 1) * $pageSize)
            ->setMaxResults($pageSize);
    }

    /**
     * A helper method that adds pagination to a given query builder object and
     * then executes the query, returning a list of results.
     *
     * @param QueryBuilder $qb
     * @param ListPaginationParams $params
     *
     * @return array
     */
    private function getPaginatedResults(QueryBuilder $qb, ListPaginationParams $params): array
    {
        return $this->getPaginatedQuery($qb, $params)
            ->getQuery()
            ->getResult();
    }
}