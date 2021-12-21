<?php

namespace App\API\Domain\User\Command\UpdateUser;

use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\API\Domain\User\DTO\UserDetailsModel;
use App\DAL\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\Persistence\ManagerRegistry;

class UpdateUserHandler implements CommandHandlerInterface
{
    private AutoMapperInterface $mapper;
    private ManagerRegistry $registry;
    private UserRepository $userRepository;

    public function __construct(
        AutoMapperInterface $mapper,
        ManagerRegistry $registry,
        UserRepository $userRepository)
    {
        $this->mapper = $mapper;
        $this->registry = $registry;
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateUserCommand $command
     *
     * @return UserDetailsModel|null
     *
     * @throws UnregisteredMappingException
     */
    public function handle(UpdateUserCommand $command): ?UserDetailsModel
    {
        $user = $this->userRepository->find($command->getUserId());
        if (!$user) return null;

        $this->mapper->mapToObject($command->getModel(), $user);
        $this->registry->getManager()->flush();

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}