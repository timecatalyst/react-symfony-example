<?php

namespace App\Features\Users\RequestHandlers\CreateUser;

use App\Features\Users\DTO\CreateUpdateUserModel;

class CreateUserRequest
{
    private CreateUpdateUserModel $model;

    public function __construct(CreateUpdateUserModel $model)
    {
        $this->model = $model;
    }

    /**
     * @return CreateUpdateUserModel
     */
    public function getModel(): CreateUpdateUserModel
    {
        return $this->model;
    }
}
