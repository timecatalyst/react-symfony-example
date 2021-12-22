<?php

namespace App\API\Controller;

use App\API\Domain\Article\Command\GetArticlesList\GetArticlesListCommand;
use App\API\Domain\Shared\DTO\ListPaginationParamsModel;
use App\API\Domain\Shared\DTO\ListResponseModel;
use App\API\Domain\Shared\DTO\ListSortingParamsModel;
use App\API\Domain\Shared\DTO\SelectListItemModel;
use App\API\Domain\User\Command\GetUserSelectListItems\GetUserSelectListItemsCommand;
use App\API\Domain\User\DTO\CreateUpdateUserModel;
use App\API\Domain\User\DTO\UserDetailsModel;
use App\API\Domain\User\Command\CreateUser\CreateUserCommand;
use App\API\Domain\User\Command\DeleteUser\DeleteUserCommand;
use App\API\Domain\User\Command\GetUser\GetUserCommand;
use App\API\Domain\User\Command\GetUsersList\GetUsersListCommand;
use App\API\Domain\User\Command\UpdateUser\UpdateUserCommand;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/v1.0/user");
 */
class UserController extends AbstractFOSRestController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Get()
     * @ParamConverter(name="sortParams")
     * @ParamConverter(name="paginationParams")
     * @View()
     *
     * @param ListSortingParamsModel $sortingParams
     * @param ListPaginationParamsModel $paginationParams
     *
     * @return ListResponseModel
     */
    public function getUsersList(
        ListSortingParamsModel $sortingParams,
        ListPaginationParamsModel $paginationParams): ListResponseModel
    {
        return $this->commandBus->handle(
            new GetUsersListCommand($sortingParams, $paginationParams));
    }

    /**
     * @Get("/select-list-items")
     * @View()
     *
     * @return SelectListItemModel[]
     */
    public function getSelectListItems(): array
    {
        return $this->commandBus->handle(new GetUserSelectListItemsCommand());
    }

    /**
     * @Get("/{userId}")
     * @View()
     *
     * @param int $userId
     *
     * @return UserDetailsModel
     */
    public function getUserDetails(int $userId): UserDetailsModel
    {
        $user = $this->commandBus->handle(new GetUserCommand($userId));
        if (!$user) throw new NotFoundHttpException('User not found');
        return $user;
    }

    /**
     * @Post()
     * @ParamConverter("model", converter="fos_rest.request_body")
     * @View(statusCode=201)
     *
     * @param CreateUpdateUserModel $model
     *
     * @return UserDetailsModel
     */
    public function createUser(CreateUpdateUserModel $model): UserDetailsModel
    {
        return $this->commandBus->handle(new CreateUserCommand($model));
    }

    /**
     * @Put("/{userId}")
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
        $user = $this->commandBus->handle(new UpdateUserCommand($userId, $model));
        if (!$user) throw new NotFoundHttpException('User not found');
        return $user;
    }

    /**
     * @Delete("/{userId}")
     * @View()
     *
     * @param int $userId
     *
     * @return int
     */
    public function deleteUser(int $userId): int
    {
        $id = $this->commandBus->handle(new DeleteUserCommand($userId));
        if (!$id) throw new NotFoundHttpException('User not found');
        return $id;
    }

    /**
     * @Get("/{userId}/article")
     * @ParamConverter(name="sortParams")
     * @ParamConverter(name="paginationParams")
     * @View()
     *
     * @param int $userId
     * @param ListSortingParamsModel $sortingParams
     * @param ListPaginationParamsModel $paginationParams
     *
     * @return ListResponseModel
     */
    public function getUserArticles(
        int $userId,
        ListSortingParamsModel $sortingParams,
        ListPaginationParamsModel $paginationParams): ListResponseModel
    {
        return $this->commandBus->handle(
            new GetArticlesListCommand($sortingParams, $paginationParams, $userId));
    }
}