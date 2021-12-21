<?php

namespace App\API\Domain\User\Mapper;

use App\API\Domain\User\DTO\CreateUpdateUserModel;
use App\API\Domain\User\DTO\UserDetailsModel;
use App\API\Domain\User\DTO\UsersListItemModel;
use App\DAL\Entity\User;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class UserMapperConfig implements AutoMapperConfiguratorInterface
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(User::class, UsersListItemModel::class);

        $config->registerMapping(User::class, UserDetailsModel::class);

        $config->registerMapping(CreateUpdateUserModel::class, User::class);
    }
}