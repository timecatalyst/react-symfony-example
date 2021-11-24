<?php

namespace App\Features\Users\RequestHandlers\UpdateUser;

use App\Features\Shared\Interfaces\RequestHandlerInterface;
use App\Features\Users\DTO\UserDetailsModel;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\ORM\ORMException;

class UpdateUserHandler implements RequestHandlerInterface
{
    /**
     * @var AutoMapperInterface
     */
    private AutoMapperInterface $mapper;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param AutoMapperInterface $mapper
     * @param UserRepository $userRepository
     */
    public function __construct(
        AutoMapperInterface $mapper,
        UserRepository $userRepository)
    {
        $this->mapper = $mapper;
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateUserRequest $request
     *
     * @return UserDetailsModel|null
     *
     * @throws UnregisteredMappingException
     * @throws ORMException
     */
    public function handle(UpdateUserRequest $request): ?UserDetailsModel
    {
        $user = $this->userRepository->getUser($request->getUserId());
        if (!$user) return null;

        $this->mapper->mapToObject($request->getModel(), $user);
        $this->userRepository->saveToDatabase();

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}