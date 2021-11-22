<?php

namespace App\Features\Users\DTO;

class UsersListResponseModel
{
    private int $totalItems;

    private array $results;

    public function __construct(int $totalItems, array $results)
    {
        $this->totalItems = $totalItems;
        $this->results = $results;
    }

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }
}