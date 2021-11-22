<?php

namespace App\Features\Users\RequestHandlers;

use App\Features\Users\DTO\UserDetailsModel;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\ORM\NonUniqueResultException;

class GetUserHandler
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
     *
     * @return UserDetailsModel|null
     *
     * @throws UnregisteredMappingException
     * @throws NonUniqueResultException
     */
    public function handle(int $id): ?UserDetailsModel
    {
        $user = $this->userRepository->getUser($id);
        if (!$user) return null;

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}