<?php

namespace App\Features\Users\RequestHandlers;

use App\Features\Users\DTO\CreateUpdateUserModel;
use App\Features\Users\DTO\UserDetailsModel;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\ORM\ORMException;

class UpdateUserHandler
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
     * @param int $id
     * @param CreateUpdateUserModel $model
     *
     * @return UserDetailsModel|null
     *
     * @throws UnregisteredMappingException
     * @throws ORMException
     */
    public function handle(int $id, CreateUpdateUserModel $model): ?UserDetailsModel
    {
        $user = $this->userRepository->getUser($id);
        if (!$user) return null;

        $this->mapper->mapToObject($model, $user);
        $this->userRepository->saveToDatabase();

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}