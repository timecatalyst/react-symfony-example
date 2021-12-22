<?php

namespace App\API\Domain\Article\Command\DeleteArticle;

use App\API\Domain\Shared\Interface\CommandHandlerInterface;
use App\DAL\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;

class DeleteArticleHandler implements CommandHandlerInterface
{
    private ManagerRegistry $registry;
    private ArticleRepository $articleRepository;

    public function __construct(
        ManagerRegistry $registry,
        ArticleRepository $articleRepository)
    {
        $this->registry = $registry;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param DeleteArticleCommand $command
     *
     * @return int|null
     */
    public function handle(DeleteArticleCommand $command): ?int
    {
        $articleId = $command->getArticleId();

        $article = $this->articleRepository->find($articleId);
        if (!$article) return null;

        $entityManager = $this->registry->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        return $articleId;
    }
}
