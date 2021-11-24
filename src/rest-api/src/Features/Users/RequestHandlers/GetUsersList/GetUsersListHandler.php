<?php

namespace App\Features\Users\RequestHandlers\GetUsersList;

use App\Features\Shared\Interfaces\RequestHandlerInterface;
use App\Features\Users\DTO\UsersListItemModel;
use App\Features\Users\DTO\UsersListResponseModel;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;

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
     */
    public function handle(GetUsersListRequest $request): UsersListResponseModel
    {
        $model = $request->getModel();

        $users = $this->userRepository->getUsersList(
            $model->getPageNumber(),
            $model->getPageSize(),
            $model->getSortBy(),
            $model->getSortDirection()
        );

        $totalItems = $this->userRepository->count([]);

        return new UsersListResponseModel(
            $totalItems,
            $this->mapper->mapMultiple($users, UsersListItemModel::class),
        );
    }
}