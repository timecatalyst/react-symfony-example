<?php

namespace App\API\Feature\User\RequestHandler\DeleteUser;

use App\API\Feature\Shared\Interface\RequestHandlerInterface;
use App\DAL\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

class DeleteUserHandler implements RequestHandlerInterface
{
    private ManagerRegistry $registry;
    private UserRepository $userRepository;

    public function __construct(
        ManagerRegistry $registry,
        UserRepository $userRepository)
    {
        $this->registry = $registry;
        $this->userRepository = $userRepository;
    }

    /**
     * @param DeleteUserRequest $request
     *
     * @return int|null
     */
    public function handle(DeleteUserRequest $request): ?int
    {
        $userId = $request->getUserId();

        $user = $this->userRepository->find($userId);
        if (!$user) return null;

        $entityManager = $this->registry->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $userId;
    }
}