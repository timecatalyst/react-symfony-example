<?php

namespace App\DAL\DTO;

class ListPaginationParams
{
    private int $pageNumber = 1;
    private int $pageSize = 10;

    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    /**
     * @param int $pageNumber
     *
     * @return $this
     */
    public function setPageNumber(int $pageNumber): ListPaginationParams
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
     *
     * @return $this
     */
    public function setPageSize(int $pageSize): ListPaginationParams
    {
        $this->pageSize = $pageSize;
        return $this;
    }
}