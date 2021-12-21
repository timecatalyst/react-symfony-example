<?php

namespace App\API\Domain\User\Command\CreateUser;

use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\API\Domain\User\DTO\UserDetailsModel;
use App\DAL\Entity\User;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\Persistence\ManagerRegistry;

class CreateUserHandler implements CommandHandlerInterface
{
    private AutoMapperInterface $mapper;
    private ManagerRegistry $registry;

    public function __construct(
        AutoMapperInterface $mapper,
        ManagerRegistry $registry)
    {
        $this->mapper = $mapper;
        $this->registry = $registry;
    }

    /**
     * @param CreateUserCommand $command
     *
     * @return UserDetailsModel
     *
     * @throws UnregisteredMappingException
     */
    public function handle(CreateUserCommand $command): UserDetailsModel
    {
        $entityManager = $this->registry->getManager();

        $user = $this->mapper->map($command->getModel(), User::class);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}