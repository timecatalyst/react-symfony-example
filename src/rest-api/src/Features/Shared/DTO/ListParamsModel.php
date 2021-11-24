<?php

namespace App\Faetures\Shared\DTO;

use FOS\RestBundle\Request\ParamFetcher;

class ListParamsModel
{
    private int $pageNumber;
    private int $pageSize;
    private string $sortBy;
    private string $sortDirection;

    /**
     * @param ParamFetcher $paramFetcher
     */
    public function __construct(ParamFetcher $paramFetcher)
    {
        $this->pageNumber = intval($paramFetcher->get('pageNumber'));
        $this->pageSize = intval($paramFetcher->get('pageSize'));
        $this->sortBy = $paramFetcher->get('sortBy');
        $this->sortDirection = $paramFetcher->get('sortDirection');
    }

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
}