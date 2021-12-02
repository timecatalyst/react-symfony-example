<?php

namespace App\API\Feature\User\RequestHandler\CreateUser;

use App\API\Feature\Shared\Interface\RequestHandlerInterface;
use App\API\Feature\User\DTO\UserDetailsModel;
use App\DAL\Repository\UserRepository;
use App\DAL\Entity\User;
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