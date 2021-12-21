<?php

namespace App\API\Domain\User\Command\GetUsersList;

use App\API\Domain\Shared\DTO\ListResponseModel;
use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\API\Domain\User\DTO\UsersListItemModel;
use App\DAL\DTO\ListPaginationParams;
use App\DAL\DTO\ListSortingParams;
use App\DAL\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class GetUsersListHandler implements CommandHandlerInterface
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
     * @param GetUsersListCommand $command
     *
     * @return ListResponseModel
     *
     * @throws UnregisteredMappingException
     */
    public function handle(GetUsersListCommand $command): ListResponseModel
    {
        $sortingParams = $this->mapper->map($command->getSortingModel(), ListSortingParams::class);
        $paginationParams = $this->mapper->map($command->getPaginationModel(), ListPaginationParams::class);

        $users = $this->userRepository->getUsersList($sortingParams, $paginationParams);
        $totalItems = $this->userRepository->count([]);

        return new ListResponseModel(
            $totalItems,
            $this->mapper->mapMultiple($users, UsersListItemModel::class),
        );
    }
}