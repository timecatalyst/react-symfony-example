<?php

namespace App\Features\Users;

use App\Features\Users\DTO\CreateUpdateUserModel;
use App\Features\Users\DTO\UserDetailsModel;
use App\Features\Users\DTO\UsersListItemModel;
use App\Entity\User;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class UsersMapperConfig implements AutoMapperConfiguratorInterface
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(User::class, UsersListItemModel::class);

        $config->registerMapping(User::class, UserDetailsModel::class);

        $config->registerMapping(CreateUpdateUserModel::class, User::class);
    }
}