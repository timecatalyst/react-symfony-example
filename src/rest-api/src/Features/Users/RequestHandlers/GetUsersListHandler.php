<?php

namespace App\Features\Users\RequestHandlers;

use App\Faetures\Shared\DTO\ListParamsModel;
use App\Features\Users\DTO\UsersListItemModel;
use App\Features\Users\DTO\UsersListResponseModel;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;

class GetUsersListHandler
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
     * @param ListParamsModel $listParamsModel
     *
     * @return UsersListResponseModel
     */
    public function handle(ListParamsModel $listParamsModel): UsersListResponseModel
    {
        $users = $this->userRepository->getUsersList(
            $listParamsModel->getPageNumber(),
            $listParamsModel->getPageSize(),
            $listParamsModel->getSortBy(),
            $listParamsModel->getSortDirection()
        );

        $totalItems = $this->userRepository->count([]);

        return new UsersListResponseModel(
            $totalItems,
            $this->mapper->mapMultiple($users, UsersListItemModel::class),
        );
    }
}