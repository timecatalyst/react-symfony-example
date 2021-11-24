<?php

namespace App\Features\Users\RequestHandlers\DeleteUser;

use App\Features\Shared\Interfaces\RequestHandlerInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class DeleteUserHandler implements RequestHandlerInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param DeleteUserRequest $request
     *
     * @return int|null
     *
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle(DeleteUserRequest $request): ?int
    {
        $userId = $request->getUserId();

        $user = $this->userRepository->getUser($userId);
        if (!$user) return null;

        $this->userRepository->deleteUser($user);
        return $userId;
    }
}