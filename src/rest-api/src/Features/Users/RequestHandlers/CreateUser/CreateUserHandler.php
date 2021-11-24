<?php

namespace App\Features\Users\RequestHandlers\CreateUser;

use App\Entity\User;
use App\Features\Shared\Interfaces\RequestHandlerInterface;
use App\Features\Users\DTO\UserDetailsModel;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\ORM\ORMException;

class CreateUserHandler implements RequestHandlerInterface
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
     * @param CreateUserRequest $request
     *
     * @return UserDetailsModel
     *
     * @throws UnregisteredMappingException
     * @throws ORMException
     */
    public function handle(CreateUserRequest $request): UserDetailsModel
    {
        $user = $this->mapper->map($request->getModel(), User::class);
        $this->userRepository->createUser($user);
        return $this->mapper->map($user, UserDetailsModel::class);
    }
}