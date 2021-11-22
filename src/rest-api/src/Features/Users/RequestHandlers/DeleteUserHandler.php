<?php

namespace App\Features\Users\RequestHandlers;

use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class DeleteUserHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     *
     * @return int|null
     *
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle(int $id): ?int
    {
        $user = $this->userRepository->getUser($id);
        if (!$user) return null;

        $this->userRepository->deleteUser($user);
        return $id;
    }
}