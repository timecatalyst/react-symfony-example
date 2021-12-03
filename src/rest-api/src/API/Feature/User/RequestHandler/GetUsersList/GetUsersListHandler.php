<?php

namespace App\API\Feature\User\RequestHandler\GetUsersList;

use App\API\Feature\Shared\Interface\RequestHandlerInterface;
use App\API\Feature\User\DTO\UsersListItemModel;
use App\API\Feature\User\DTO\UsersListResponseModel;
use App\DAL\Repository\UserRepository;
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

        $users = $this->userRepository->getPaginatedUsersList(
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