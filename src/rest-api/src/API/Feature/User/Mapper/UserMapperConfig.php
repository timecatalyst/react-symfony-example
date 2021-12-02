<?php

namespace App\API\Feature\User\Mapper;

use App\API\Feature\User\DTO\CreateUpdateUserModel;
use App\API\Feature\User\DTO\UserDetailsModel;
use App\API\Feature\User\DTO\UsersListItemModel;
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