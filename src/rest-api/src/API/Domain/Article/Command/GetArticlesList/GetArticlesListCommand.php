<?php

namespace App\API\Domain\Article\Command\GetArticlesList;

use App\API\Domain\Shared\DTO\ListPaginationParamsModel;
use App\API\Domain\Shared\DTO\ListSortingParamsModel;

class GetArticlesListCommand
{
    private ListSortingParamsModel $sortingModel;
    private ListPaginationParamsModel $paginationModel;
    private ?int $userId;

    public function __construct(
        ListSortingParamsModel $sortingModel,
        ListPaginationParamsModel $paginationModel,
        int $userId = null)
    {
        $this->sortingModel = $sortingModel;
        $this->paginationModel = $paginationModel;
        $this->userId = $userId;
    }

    /**
     * @return ListSortingParamsModel
     */
    public function getSortingModel(): ListSortingParamsModel
    {
        return $this->sortingModel;
    }

    /**
     * @return ListPaginationParamsModel
     */
    public function getPaginationModel(): ListPaginationParamsModel
    {
        return $this->paginationModel;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }
}