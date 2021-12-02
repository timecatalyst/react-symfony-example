<?php

namespace App\API\ParamConverter;

use App\API\Feature\Shared\DTO\ListParamsModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ListParamsConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $inputBag = $request->query;

        $listParams = (new ListParamsModel())
            ->setPageNumber(intval($inputBag->get('pageNumber', '1')))
            ->setPageSize(intval($inputBag->get('pageSize', '10')))
            ->setSortBy($inputBag->get('sortBy', 'name'))
            ->setSortDirection($inputBag->get('sortDirection', 'ASC'));

        $request->attributes->set($configuration->getName(), $listParams);
        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getClass() === ListParamsModel::class;
    }
}