<?php

namespace App\Features\Users\RequestHandlers;

use App\Entity\User;
use App\Features\Users\DTO\CreateUpdateUserModel;
use App\Features\Users\DTO\UserDetailsModel;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\ORM\ORMException;

class CreateUserHandler
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
     * @param CreateUpdateUserModel $model
     *
     * @return UserDetailsModel
     *
     * @throws ORMException
     * @throws UnregisteredMappingException
     */
    public function handle(CreateUpdateUserModel $model): UserDetailsModel
    {
        $user = $this->mapper->map($model, User::class);
        $this->userRepository->createUser($user);
        return $this->mapper->map($user, UserDetailsModel::class);
    }
}