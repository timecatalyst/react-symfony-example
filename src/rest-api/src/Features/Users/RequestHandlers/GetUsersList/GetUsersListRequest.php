<?php

namespace App\Features\Users\RequestHandlers\GetUsersList;

use App\Features\Shared\DTO\ListParamsModel;

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