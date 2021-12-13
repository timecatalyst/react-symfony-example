<?php

namespace App\API\Feature\Shared\Mapper;

use App\API\Feature\Shared\DTO\ListPaginationParamsModel;
use App\API\Feature\Shared\DTO\ListSortingParamsModel;
use App\DAL\DTO\ListPaginationParams;
use App\DAL\DTO\ListSortingParams;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class SharedMapperConfig implements AutoMapperConfiguratorInterface
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(ListPaginationParamsModel::class, ListPaginationParams::class);

        $config->registerMapping(ListSortingParamsModel::class, ListSortingParams::class);
    }
}