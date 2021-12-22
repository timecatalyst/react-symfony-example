<?php

namespace App\API\Domain\Article\Command\CreateArticle;

use App\API\Domain\Article\DTO\ArticleDetailsModel;
use App\API\Domain\Article\DTO\CreateUpdateArticleModel;
use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\DAL\Entity\Article;
use App\DAL\Entity\User;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;

class CreateArticleHandler implements CommandHandlerInterface
{
    private AutoMapperInterface $mapper;
    private ManagerRegistry $registry;

    public function __construct(
        AutoMapperInterface $mapper,
        ManagerRegistry $registry)
    {
        $this->mapper = $mapper;
        $this->registry = $registry;
    }

    /**
     * @param CreateArticleCommand $command
     *
     * @return ArticleDetailsModel
     *
     * @throws UnregisteredMappingException
     */
    public function handle(CreateArticleCommand $command): ArticleDetailsModel
    {
        $article = $this->buildArticleEntity($command->getModel());

        $entityManager = $this->registry->getManager();
        $entityManager->persist($article);
        $entityManager->flush();

        return $this->mapper->map($article, ArticleDetailsModel::class);
    }

    /**
     * @param CreateUpdateArticleModel $model
     *
     * @return Article
     *
     * @throws UnregisteredMappingException
     */
    private function buildArticleEntity(CreateUpdateArticleModel $model): Article
    {
        $article = $this->mapper->map($model, Article::class);

        $em = $this->registry->getManager();
        $article->setUser($em->getReference(User::class, $model->getUserId()));

        if ($model->isPublished()) $article->setPublishedDate(new DateTime());

        return $article;
    }
}
