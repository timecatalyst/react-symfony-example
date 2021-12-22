<?php

namespace App\API\Domain\Article\Command\GetArticle;

use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\API\Domain\Article\DTO\ArticleDetailsModel;
use App\DAL\Repository\ArticleRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class GetArticleHandler implements CommandHandlerInterface
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
     * @param GetArticleCommand $command
     *
     * @return ArticleDetailsModel|null
     *
     * @throws UnregisteredMappingException
     */
    public function handle(GetArticleCommand $command): ?ArticleDetailsModel
    {
        $article = $this->articleRepository->find($command->getArticleId());
        if (!$article) return null;

        return $this->mapper->map($article, ArticleDetailsModel::class);
    }
}
