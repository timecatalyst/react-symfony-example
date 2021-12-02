<?php

namespace App\API\Feature\User\RequestHandler\GetUsersList;

use App\API\Feature\Shared\DTO\ListParamsModel;

class GetUsersListRequest
{
    private ListParamsModel $model;

    public function __construct(ListParamsModel $model)
    {
        $this->model = $model;
    }

    /**
     * @return ListParamsModel
     */
    public function getModel(): ListParamsModel
    {
        return $this->model;
    }
}