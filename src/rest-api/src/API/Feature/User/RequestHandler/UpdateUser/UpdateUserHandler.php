<?php

namespace App\API\Feature\User\RequestHandler\UpdateUser;

use App\API\Feature\Shared\Interface\RequestHandlerInterface;
use App\API\Feature\User\DTO\UserDetailsModel;
use App\DAL\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\Persistence\ManagerRegistry;

class UpdateUserHandler implements RequestHandlerInterface
{
    private AutoMapperInterface $mapper;
    private ManagerRegistry $registry;
    private UserRepository $userRepository;

    public function __construct(
        AutoMapperInterface $mapper,
        ManagerRegistry $registry,
        UserRepository $userRepository)
    {
        $this->mapper = $mapper;
        $this->registry = $registry;
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateUserRequest $request
     *
     * @return UserDetailsModel|null
     *
     * @throws UnregisteredMappingException
     */
    public function handle(UpdateUserRequest $request): ?UserDetailsModel
    {
        $user = $this->userRepository->find($request->getUserId());
        if (!$user) return null;

        $this->mapper->mapToObject($request->getModel(), $user);
        $this->registry->getManager()->flush();

        return $this->mapper->map($user, UserDetailsModel::class);
    }
}