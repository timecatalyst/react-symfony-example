<?php

namespace App\API\Domain\User\Command\CreateUser;

use App\API\Domain\User\DTO\CreateUpdateUserModel;

class CreateUserCommand
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
