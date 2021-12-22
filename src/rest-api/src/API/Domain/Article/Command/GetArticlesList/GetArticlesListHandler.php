<?php

namespace App\API\Domain\Article\Command\GetArticlesList;

use App\API\Domain\Shared\DTO\ListResponseModel;
use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\API\Domain\Article\DTO\ArticlesListItemModel;
use App\DAL\DTO\ListPaginationParams;
use App\DAL\DTO\ListSortingParams;
use App\DAL\Repository\ArticleRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class GetArticlesListHandler implements CommandHandlerInterface
{
    private AutoMapperInterface $mapper;
    private ArticleRepository $articleRepository;

    public function __construct(
        AutoMapperInterface $mapper,
        ArticleRepository $articleRepository)
    {
        $this->mapper = $mapper;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param GetArticlesListCommand $command
     *
     * @return ListResponseModel
     *
     * @throws UnregisteredMappingException
     */
    public function handle(GetArticlesListCommand $command): ListResponseModel
    {
        $sortingParams = $this->mapper->map($command->getSortingModel(), ListSortingParams::class);
        $paginationParams = $this->mapper->map($command->getPaginationModel(), ListPaginationParams::class);

        $articles = $this->articleRepository->getArticlesList($sortingParams, $paginationParams, $command->getUserId());
        $totalItems = $this->articleRepository->count([]);

        return new ListResponseModel(
            $totalItems,
            $this->mapper->mapMultiple($articles, ArticlesListItemModel::class),
        );
    }
}
