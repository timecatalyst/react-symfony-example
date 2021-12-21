<?php

namespace App\API\Domain\Shared\DTO;

class ListPaginationParamsModel
{
    private int $pageNumber;
    private int $pageSize;

    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    /**
     * @param int $pageNumber
     * @return ListPaginationParamsModel
     */
    public function setPageNumber(int $pageNumber): ListPaginationParamsModel
    {
        $this->pageNumber = $pageNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     * @return ListPaginationParamsModel
     */
    public function setPageSize(int $pageSize): ListPaginationParamsModel
    {
        $this->pageSize = $pageSize;
        return $this;
    }
}