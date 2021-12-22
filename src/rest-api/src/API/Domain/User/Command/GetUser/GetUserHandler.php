<?php

namespace App\API\Domain\User\Command\GetUser;

use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\API\Domain\User\DTO\UserDetailsModel;
use App\DAL\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class GetUserHandler implements CommandHandlerInterface
{
    private AutoMapperInterface $mapper;
    private UserRepository $userRepository;

    public function __construct(
        AutoMapperInterface $mapper,
        UserRepository $userRepository)
    {
        $this->mapper = $mapper;
        $this->userRepository = $userRepository;
    }

    /**
     * @param GetUserCommand $command
     *
     * @return UserDetailsModel|null
     *
     * @throws UnregisteredMappingException
     */
    public function handle(GetUserCommand $command): ?UserDetailsModel
    {
        $user = $this->userRepository->find($command->getUserId());
        if (!$user) return null;

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}