<?php

namespace App\API\Domain\User\Command\GetUsersList;

use App\API\Domain\Shared\DTO\ListPaginationParamsModel;
use App\API\Domain\Shared\DTO\ListSortingParamsModel;

class GetUsersListCommand
{
    private ListSortingParamsModel $sortingModel;
    private ListPaginationParamsModel $paginationModel;

    public function __construct(
        ListSortingParamsModel $sortingModel,
        ListPaginationParamsModel $paginationModel)
    {
        $this->sortingModel = $sortingModel;
        $this->paginationModel = $paginationModel;
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
}