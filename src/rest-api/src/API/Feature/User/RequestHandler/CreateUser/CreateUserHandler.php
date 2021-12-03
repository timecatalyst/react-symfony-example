<?php

namespace App\API\Feature\User\RequestHandler\CreateUser;

use App\API\Feature\Shared\Interface\RequestHandlerInterface;
use App\API\Feature\User\DTO\UserDetailsModel;
use App\DAL\Entity\User;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\Persistence\ManagerRegistry;

class CreateUserHandler implements RequestHandlerInterface
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
     * @param CreateUserRequest $request
     *
     * @return UserDetailsModel
     *
     * @throws UnregisteredMappingException
     */
    public function handle(CreateUserRequest $request): UserDetailsModel
    {
        $entityManager = $this->registry->getManager();

        $user = $this->mapper->map($request->getModel(), User::class);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}