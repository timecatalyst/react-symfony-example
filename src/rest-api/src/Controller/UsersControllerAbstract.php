<?php

namespace App\Controller;

use App\Faetures\Shared\DTO\ListParamsModel;
use App\Features\Users\DTO\CreateUpdateUserModel;
use App\Features\Users\RequestHandlers\CreateUser\CreateUserRequest;
use App\Features\Users\RequestHandlers\DeleteUser\DeleteUserRequest;
use App\Features\Users\RequestHandlers\GetUser\GetUserRequest;
use App\Features\Users\RequestHandlers\GetUsersList\GetUsersListRequest;
use App\Features\Users\RequestHandlers\UpdateUser\UpdateUserRequest;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UsersControllerAbstract extends AbstractApiController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Get("v1.0/users")
     *
     * @QueryParam(name="pageNumber", requirements="\d+", default="1")
     * @QueryParam(name="pageSize", requirements="\d+", default="10")
     * @QueryParam(name="sortBy", requirements="(name|email)", default="name")
     * @QueryParam(name="sortDirection", requirements="(asc|desc)", default="asc")
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getUsersList(ParamFetcher $paramFetcher): Response
    {
        $model = new ListParamsModel($paramFetcher);
        $users = $this->commandBus->handle(new GetUsersListRequest($model));
        return $this->okResponse($users);
    }

    /**
     * @Get("v1.0/users/{userId}")
     *
     * @param int $userId
     *
     * @return Response
     */
    public function getUserDetails(int $userId): Response
    {
        $user = $this->commandBus->handle(new GetUserRequest($userId));
        return $user ? $this->okResponse($user) : $this->notFoundResponse();
    }

    /**
     * @Post("v1.0/users")
     * @ParamConverter("model", converter="fos_rest.request_body")
     *
     * @param CreateUpdateUserModel $model
     * @param ConstraintViolationListInterface $validationErrors
     *
     * @return Response
     */
    public function createUser(
        CreateUpdateUserModel $model,
        ConstraintViolationListInterface $validationErrors): Response
    {
        if (count($validationErrors) > 0)
            return $this->unprocessableEntityResponse($validationErrors);

        $user = $this->commandBus->handle(new CreateUserRequest($model));
        return $this->createdResponse($user);
    }

    /**
     * @Put("v1.0/users/{userId}")
     * @ParamConverter("model", converter="fos_rest.request_body")
     *
     * @param int $userId
     * @param CreateUpdateUserModel $model
     * @param ConstraintViolationListInterface $validationErrors
     *
     * @return Response
     */
    public function updateUser(
        int $userId,
        CreateUpdateUserModel $model,
        ConstraintViolationListInterface $validationErrors): Response
    {
        if (count($validationErrors) > 0)
            return $this->unprocessableEntityResponse($validationErrors);

        $user = $this->commandBus->handle(new UpdateUserRequest($userId, $model));
        return $user ? $this->okResponse($user) : $this->notFoundResponse();
    }

    /**
     * @Delete("v1.0/users/{userId}")
     *
     * @param int $userId
     *
     * @return Response
     */
    public function deleteUser(int $userId): Response
    {
        $id = $this->commandBus->handle(new DeleteUserRequest($userId));
        return $id ? $this->okResponse($userId) : $this->notFoundResponse();
    }
}