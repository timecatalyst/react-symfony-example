<?php

namespace App\API\Feature\User\RequestHandler\GetUser;

class GetUserRequest
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}