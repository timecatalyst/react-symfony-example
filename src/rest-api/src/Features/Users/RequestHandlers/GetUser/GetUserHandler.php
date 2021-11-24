<?php

namespace App\Features\Users\RequestHandlers\GetUser;

use App\Features\Shared\Interfaces\RequestHandlerInterface;
use App\Features\Users\DTO\UserDetailsModel;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\ORM\NonUniqueResultException;

class GetUserHandler implements RequestHandlerInterface
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
     * @param GetUserRequest $request
     *
     * @return UserDetailsModel|null
     *
     * @throws UnregisteredMappingException
     * @throws NonUniqueResultException
     */
    public function handle(GetUserRequest $request): ?UserDetailsModel
    {
        $user = $this->userRepository->getUser($request->getUserId());
        if (!$user) return null;

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}