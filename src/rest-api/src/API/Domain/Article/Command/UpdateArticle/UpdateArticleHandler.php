<?php

namespace App\API\Domain\Article\Command\UpdateArticle;

use App\API\Domain\Article\DTO\CreateUpdateArticleModel;
use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\API\Domain\Article\DTO\ArticleDetailsModel;
use App\DAL\Entity\Article;
use App\DAL\Entity\User;
use App\DAL\Repository\ArticleRepository;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;

class UpdateArticleHandler implements CommandHandlerInterface
{
    private AutoMapperInterface $mapper;
    private ManagerRegistry $registry;
    private ArticleRepository $articleRepository;

    public function __construct(
        AutoMapperInterface $mapper,
        ManagerRegistry $registry,
        ArticleRepository $articleRepository)
    {
        $this->mapper = $mapper;
        $this->registry = $registry;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param UpdateArticleCommand $command
     *
     * @return ArticleDetailsModel|null
     *
     * @throws UnregisteredMappingException
     */
    public function handle(UpdateArticleCommand $command): ?ArticleDetailsModel
    {
        $article = $this->articleRepository->find($command->getArticleId());
        if (!$article) return null;

        $this->updateArticleEntity($article, $command->getModel());
        $this->registry->getManager()->flush();

        return $this->mapper->map($article, ArticleDetailsModel::class);
    }

    /**
     * @param Article $article
     *
     * @param CreateUpdateArticleModel $model
     *
     * @throws UnregisteredMappingException
     */
    private function updateArticleEntity(Article $article, CreateUpdateArticleModel $model)
    {
        if ($model->isPublished() && !$article->isPublished())
            $article->setPublishedDate(new DateTime());

        if ($model->getUserId() !== $article->getUserId())
        {
            $em = $this->registry->getManager();
            $article->setUser($em->getReference(User::class, $model->getUserId()));
        }

        $this->mapper->mapToObject($model, $article);
    }
}
