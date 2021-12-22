<?php

namespace App\API\Domain\User\Command\GetUserSelectListItems;

use App\API\Domain\Shared\DTO\SelectListItemModel;
use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\DAL\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;

class GetUserSelectListItemsHandler implements CommandHandlerInterface
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
     * @param GetUserSelectListItemsCommand $command
     *
     * @return array
     */
    public function handle(GetUserSelectListItemsCommand $command): array
    {
        $users = $this->userRepository->findAll();
        return $this->mapper->mapMultiple($users, SelectListItemModel::class);
    }
}