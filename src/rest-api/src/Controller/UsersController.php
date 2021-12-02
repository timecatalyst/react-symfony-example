<?php

namespace App\Controller;

use App\Features\Shared\DTO\ListParamsModel;
use App\Features\Users\DTO\CreateUpdateUserModel;
use App\Features\Users\DTO\UserDetailsModel;
use App\Features\Users\DTO\UsersListResponseModel;
use App\Features\Users\RequestHandlers\CreateUser\CreateUserRequest;
use App\Features\Users\RequestHandlers\DeleteUser\DeleteUserRequest;
use App\Features\Users\RequestHandlers\GetUser\GetUserRequest;
use App\Features\Users\RequestHandlers\GetUsersList\GetUsersListRequest;
use App\Features\Users\RequestHandlers\UpdateUser\UpdateUserRequest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UsersController extends AbstractFOSRestController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Get("v1.0/users")
     * @ParamConverter(name="listParams")
     * @View()
     *
     * @param ListParamsModel $listParams
     *
     * @return UsersListResponseModel
     */
    public function getUsersList(ListParamsModel $listParams): UsersListResponseModel
    {
        return $this->commandBus->handle(new GetUsersListRequest($listParams));
    }

    /**
     * @Get("v1.0/users/{userId}")
     * @View()
     *
     * @param int $userId
     *
     * @return UserDetailsModel
     */
    public function getUserDetails(int $userId): UserDetailsModel
    {
        $user = $this->commandBus->handle(new GetUserRequest($userId));
        if (!$user) throw new NotFoundHttpException('User not found');
        return $user;
    }

    /**
     * @Post("v1.0/users")
     * @ParamConverter("model", converter="fos_rest.request_body")
     * @View(statusCode=201)
     *
     * @param CreateUpdateUserModel $model
     *
     * @return UserDetailsModel
     */
    public function createUser(CreateUpdateUserModel $model): UserDetailsModel
    {
        return $this->commandBus->handle(new CreateUserRequest($model));
    }

    /**
     * @Put("v1.0/users/{userId}")
     * @ParamConverter("model", converter="fos_rest.request_body")
     * @View()
     *
     * @param int $userId
     * @param CreateUpdateUserModel $model
     *
     * @return UserDetailsModel
     */
    public function updateUser(int $userId, CreateUpdateUserModel $model): UserDetailsModel
    {
        $user = $this->commandBus->handle(new UpdateUserRequest($userId, $model));
        if (!$user) throw new NotFoundHttpException('User not found');
        return $user;
    }

    /**
     * @Delete("v1.0/users/{userId}")
     * @View()
     *
     * @param int $userId
     *
     * @return int
     */
    public function deleteUser(int $userId): int
    {
        $id = $this->commandBus->handle(new DeleteUserRequest($userId));
        if (!$id) throw new NotFoundHttpException('User not found');
        return $id;
    }
}