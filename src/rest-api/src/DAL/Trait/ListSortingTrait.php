<?php

namespace App\DAL\Trait;

use App\DAL\DTO\ListSortingParams;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use UnexpectedValueException;

trait ListSortingTrait
{
    /**
     * An array defining sortable column names mapped to their collection column
     * counterparts.
     *
     * Eg: ['name' => 'u.name', 'age' => 'u.age']
     *
     * This map should be initialized in the parent class constructor for any
     * repository that intends to provide sortable list data.
     */
    private array $sortableColumns = [];

    /**
     * An internal method used to validate the sort parameters before attempting
     * to construct and execute a query.
     *
     * @param ListSortingParams $params
     */
    private function validateSortingParams(ListSortingParams $params)
    {
        if (!array_key_exists($params->getSortBy(), $this->sortableColumns))
            throw new UnexpectedValueException("Invalid sortBy column");

        if (!in_array($params->getSortDirection(), [Criteria::ASC, Criteria::DESC]))
            throw new UnexpectedValueException("Invalid sortDirection");
    }

    /**
     * An internal method that returns the given sortBy parameter. It attempts
     * to determine a suitable default parameter if no value was provided.
     *
     * @param ListSortingParams $params
     * @return string|null
     */
    private function getSortByValue(ListSortingParams $params): ?string
    {
        $sortBy = $params->getSortBy();
        if (isset($sortBy)) return $sortBy;

        $sortBy = array_key_first($this->sortableColumns);
        $params->setSortBy($sortBy);
        return $sortBy;
    }

    /**
     * Adds sorting to a given query builder object.
     *
     * @param QueryBuilder $qb
     * @param ListSortingParams $params
     *
     * @return QueryBuilder
     */
    private function getSortedQuery(QueryBuilder $qb, ListSortingParams $params): QueryBuilder
    {
        $sortBy = $this->getSortByValue($params);
        if (!isset($sortBy)) return $qb;

        $this->validateSortingParams($params);

        return $qb->orderBy($this->sortableColumns[$sortBy], $params->getSortDirection());
    }

    /**
     * A helper method that adds sorting to a given query builder object and
     * then executes the query, returning a list of results.
     *
     * @param QueryBuilder $qb
     * @param ListSortingParams $params
     *
     * @return array
     */
    private function getSortedResults(QueryBuilder $qb, ListSortingParams $params): array
    {
        return $this->getSortedQuery($qb, $params)
            ->getQuery()
            ->getResult();
    }
}