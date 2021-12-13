<?php

namespace App\DAL\DTO;

use Doctrine\Common\Collections\Criteria;

class ListSortingParams
{
    private string|null $sortBy;
    private string $sortDirection = Criteria::ASC;

    /**
     * @return string|null
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * @param string|null $sortBy
     *
     * @return $this
     */
    public function setSortBy(?string $sortBy): ListSortingParams
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortDirection(): string
    {
        return $this->sortDirection;
    }

    /**
     * @param string $sortDirection
     *
     * @return $this
     */
    public function setSortDirection(string $sortDirection): ListSortingParams
    {
        $this->sortDirection = $sortDirection;
        return $this;
    }
}