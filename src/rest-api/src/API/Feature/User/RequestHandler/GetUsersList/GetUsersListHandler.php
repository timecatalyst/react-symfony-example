<?php

namespace App\API\Feature\User\RequestHandler\GetUsersList;

use App\API\Feature\Shared\Interface\RequestHandlerInterface;
use App\API\Feature\User\DTO\UsersListItemModel;
use App\API\Feature\User\DTO\UsersListResponseModel;
use App\DAL\DTO\ListPaginationParams;
use App\DAL\DTO\ListSortingParams;
use App\DAL\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class GetUsersListHandler implements RequestHandlerInterface
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
     * @param GetUsersListRequest $request
     *
     * @return UsersListResponseModel
     *
     * @throws UnregisteredMappingException
     */
    public function handle(GetUsersListRequest $request): UsersListResponseModel
    {
        $sortingParams = $this->mapper->map($request->getSortingModel(), ListSortingParams::class);
        $paginationParams = $this->mapper->map($request->getPaginationModel(), ListPaginationParams::class);

        $users = $this->userRepository->getUsersList($sortingParams, $paginationParams);
        $totalItems = $this->userRepository->count([]);

        return new UsersListResponseModel(
            $totalItems,
            $this->mapper->mapMultiple($users, UsersListItemModel::class),
        );
    }
}