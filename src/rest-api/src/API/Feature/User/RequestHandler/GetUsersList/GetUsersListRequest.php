<?php

namespace App\API\Feature\User\RequestHandler\GetUsersList;

use App\API\Feature\Shared\DTO\ListPaginationParamsModel;
use App\API\Feature\Shared\DTO\ListSortingParamsModel;

class GetUsersListRequest
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