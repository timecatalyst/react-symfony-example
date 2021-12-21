<?php

namespace App\API\Domain\User\Command\UpdateUser;

use App\API\Domain\User\DTO\CreateUpdateUserModel;

class UpdateUserCommand
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