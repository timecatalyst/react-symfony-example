<?php

namespace App\Controller;

use App\Faetures\Shared\DTO\ListParamsModel;
use App\Features\Users\DTO\CreateUpdateUserModel;
use App\Features\Users\RequestHandlers\CreateUserHandler;
use App\Features\Users\RequestHandlers\DeleteUserHandler;
use App\Features\Users\RequestHandlers\GetUserHandler;
use App\Features\Users\RequestHandlers\GetUsersListHandler;
use App\Features\Users\RequestHandlers\UpdateUserHandler;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UsersController extends ApiController
{
    private CreateUserHandler $createUser;
    private DeleteUserHandler $deleteUser;
    private GetUserHandler $getUser;
    private GetUsersListHandler $getUsersList;
    private UpdateUserHandler $updateUser;

    public function __construct(
        CreateUserHandler $createUser,
        DeleteUserHandler $deleteUser,
        GetUserHandler $getUser,
        GetUsersListHandler $getUsersList,
        UpdateUserHandler $updateUser)
    {
        $this->createUser = $createUser;
        $this->deleteUser = $deleteUser;
        $this->getUser = $getUser;
        $this->getUsersList = $getUsersList;
        $this->updateUser = $updateUser;
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
        $users = $this->getUsersList->handle(new ListParamsModel($paramFetcher));
        return $this->okResponse($users);
    }

    /**
     * @Get("v1.0/users/{userId}")
     *
     * @param int $userId
     *
     * @return Response
     *
     * @throws NonUniqueResultException
     * @throws UnregisteredMappingException
     */
    public function getUserDetails(int $userId): Response
    {
        $user = $this->getUser->handle($userId);
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
     *
     * @throws ORMException
     * @throws UnregisteredMappingException
     */
    public function createUser(
        CreateUpdateUserModel $model,
        ConstraintViolationListInterface $validationErrors): Response
    {
        if (count($validationErrors) > 0)
            return $this->unprocessableEntityResponse($validationErrors);

        $user = $this->createUser->handle($model);
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
     *
     * @throws ORMException
     * @throws UnregisteredMappingException
     */
    public function updateUser(
        int $userId,
        CreateUpdateUserModel $model,
        ConstraintViolationListInterface $validationErrors): Response
    {
        if (count($validationErrors) > 0)
            return $this->unprocessableEntityResponse($validationErrors);

        $user = $this->updateUser->handle($userId, $model);
        return $user ? $this->okResponse($user) : $this->notFoundResponse();
    }

    /**
     * @Delete("v1.0/users/{userId}")
     *
     * @param int $userId
     *
     * @return Response
     *
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteUser(int $userId): Response
    {
        $id = $this->deleteUser->handle($userId);
        return $id ? $this->okResponse($userId) : $this->notFoundResponse();
    }
}