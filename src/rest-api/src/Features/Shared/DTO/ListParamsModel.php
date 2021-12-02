<?php

namespace App\Features\Shared\DTO;

class ListParamsModel
{
    private int $pageNumber;
    private int $pageSize;
    private string $sortBy;
    private string $sortDirection;

    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return string
     */
    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    /**
     * @return string
     */
    public function getSortDirection(): string
    {
        return $this->sortDirection;
    }

    /**
     * @param int $pageNumber
     * @return ListParamsModel
     */
    public function setPageNumber(int $pageNumber): ListParamsModel
    {
        $this->pageNumber = $pageNumber;
        return $this;
    }

    /**
     * @param int $pageSize
     * @return ListParamsModel
     */
    public function setPageSize(int $pageSize): ListParamsModel
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @param mixed|string $sortBy
     * @return ListParamsModel
     */
    public function setSortBy(string $sortBy): ListParamsModel
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * @param mixed|string $sortDirection
     * @return ListParamsModel
     */
    public function setSortDirection(string $sortDirection): ListParamsModel
    {
        $this->sortDirection = $sortDirection;
        return $this;
    }
}