<?php

namespace App\API\Domain\User\Command\DeleteUser;

use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\DAL\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

class DeleteUserHandler implements CommandHandlerInterface
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
     * @param DeleteUserCommand $command
     *
     * @return int|null
     */
    public function handle(DeleteUserCommand $command): ?int
    {
        $userId = $command->getUserId();

        $user = $this->userRepository->find($userId);
        if (!$user) return null;

        $entityManager = $this->registry->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $userId;
    }
}