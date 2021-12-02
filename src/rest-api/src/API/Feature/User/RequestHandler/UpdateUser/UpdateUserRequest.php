<?php

namespace App\API\Feature\User\RequestHandler\UpdateUser;

use App\API\Feature\User\DTO\CreateUpdateUserModel;

class UpdateUserRequest
{
    private int $userId;
    private CreateUpdateUserModel $model;

    public function __construct(int $userId, CreateUpdateUserModel $model)
    {
        $this->userId = $userId;
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return CreateUpdateUserModel
     */
    public function getModel(): CreateUpdateUserModel
    {
        return $this->model;
    }
}