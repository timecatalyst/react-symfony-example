<?php

namespace App\API\Domain\Shared\DTO;

class ListSortingParamsModel
{
    private string|null $sortBy;
    private string $sortDirection;

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
     * @return ListSortingParamsModel
     */
    public function setSortBy(string $sortBy = null): ListSortingParamsModel
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
     * @return ListSortingParamsModel
     */
    public function setSortDirection(string $sortDirection): ListSortingParamsModel
    {
        $this->sortDirection = $sortDirection;
        return $this;
    }
}