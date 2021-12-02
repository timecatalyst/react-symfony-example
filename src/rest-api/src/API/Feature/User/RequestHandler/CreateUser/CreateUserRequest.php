<?php

namespace App\API\Feature\User\RequestHandler\CreateUser;

use App\API\Feature\User\DTO\CreateUpdateUserModel;

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
