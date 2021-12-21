<?php

namespace App\API\Domain\Shared\Mapper;

use App\API\Domain\Shared\DTO\ListPaginationParamsModel;
use App\API\Domain\Shared\DTO\ListSortingParamsModel;
use App\API\Domain\Shared\DTO\SelectListItemModel;
use App\DAL\DTO\ListPaginationParams;
use App\DAL\DTO\ListSortingParams;
use App\DAL\Entity\User;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class DomainMapperConfig implements AutoMapperConfiguratorInterface
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(ListPaginationParamsModel::class, ListPaginationParams::class);

        $config->registerMapping(ListSortingParamsModel::class, ListSortingParams::class);

        $config->registerMapping(User::class, SelectListItemModel::class)
            ->forMember('label', fn(User $user) => $user->getName())
            ->forMember('value', fn(User $user) => $user->getId());
    }
}
