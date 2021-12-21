<?php

namespace App\API\ParamConverter;

use App\API\Domain\Shared\DTO\ListSortingParamsModel;
use Doctrine\Common\Collections\Criteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ListSortingParamsConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $inputBag = $request->query;

        $model = (new ListSortingParamsModel())->setSortBy($inputBag->get('sortBy'));
        $sortDirection = strtoupper($inputBag->get('sortDirection', Criteria::ASC));
        $model->setSortDirection($sortDirection);

        $request->attributes->set($configuration->getName(), $model);
        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getClass() === ListSortingParamsModel::class;
    }
}