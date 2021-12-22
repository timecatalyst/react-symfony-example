<?php

namespace App\API\Domain\Article\Mapper;

use App\API\Domain\Article\DTO\ArticleDetailsModel;
use App\API\Domain\Article\DTO\ArticlesListItemModel;
use App\API\Domain\Article\DTO\CreateUpdateArticleModel;
use App\DAL\Entity\Article;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class ArticleMapperConfig implements AutoMapperConfiguratorInterface
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(Article::class, ArticlesListItemModel::class)
            ->forMember('userName', fn(Article $article) => $article->getUser()->getName());

        $config->registerMapping(Article::class, ArticleDetailsModel::class)
            ->forMember('userName', fn(Article $article) => $article->getUser()->getName());

        $config->registerMapping(CreateUpdateArticleModel::class, Article::class);
    }
}