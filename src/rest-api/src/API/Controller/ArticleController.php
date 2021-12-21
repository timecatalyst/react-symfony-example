<?php

namespace App\API\Controller;

use App\API\Domain\Article\Command\CreateArticle\CreateArticleCommand;
use App\API\Domain\Article\Command\DeleteArticle\DeleteArticleCommand;
use App\API\Domain\Article\Command\GetArticle\GetArticleCommand;
use App\API\Domain\Article\Command\UpdateArticle\UpdateArticleCommand;
use App\API\Domain\Article\DTO\ArticleDetailsModel;
use App\API\Domain\Article\DTO\CreateUpdateArticleModel;
use App\API\Domain\Shared\DTO\ListPaginationParamsModel;
use App\API\Domain\Shared\DTO\ListResponseModel;
use App\API\Domain\Shared\DTO\ListSortingParamsModel;
use App\API\Domain\Article\Command\GetArticlesList\GetArticlesListCommand;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/v1.0/article")
 */
class ArticleController extends AbstractFOSRestController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Get()
     * @ParamConverter(name="sortParams")
     * @ParamConverter(name="paginationParams")
     * @View()
     *
     * @param ListSortingParamsModel $sortingParams
     * @param ListPaginationParamsModel $paginationParams
     *
     * @return ListResponseModel
     */
    public function getArticlesList(
        ListSortingParamsModel $sortingParams,
        ListPaginationParamsModel $paginationParams): ListResponseModel
    {
        return $this->commandBus->handle(
            new GetArticlesListCommand($sortingParams, $paginationParams));
    }

    /**
     * @Get("/{articleId}")
     * @View()
     *
     * @param int $articleId
     *
     * @return ArticleDetailsModel
     */
    public function getArticleDetails(int $articleId): ArticleDetailsModel
    {
        $article = $this->commandBus->handle(new GetArticleCommand($articleId));
        if (!$article) throw new NotFoundHttpException('Article not found');
        return $article;
    }

    /**
     * @Post()
     * @ParamConverter("model", converter="fos_rest.request_body")
     * @View(statusCode=201)
     *
     * @param CreateUpdateArticleModel $model
     *
     * @return ArticleDetailsModel
     */
    public function createArticle(CreateUpdateArticleModel $model): ArticleDetailsModel
    {
        return $this->commandBus->handle(new CreateArticleCommand($model));
    }

    /**
     * @Put("/{articleId}")
     * @ParamConverter("model", converter="fos_rest.request_body")
     * @View()
     *
     * @param int $articleId
     * @param CreateUpdateArticleModel $model
     *
     * @return ArticleDetailsModel
     */
    public function updateArticle(int $articleId, CreateUpdateArticleModel $model): ArticleDetailsModel
    {
        $article = $this->commandBus->handle(new UpdateArticleCommand($articleId, $model));
        if (!$article) throw new NotFoundHttpException('Article not found');
        return $article;
    }

    /**
     * @Delete("/{articleId}")
     * @View()
     *
     * @param int $articleId
     *
     * @return int
     */
    public function deleteArticle(int $articleId): int
    {
        $id = $this->commandBus->handle(new DeleteArticleCommand($articleId));
        if (!$id) throw new NotFoundHttpException('Article not found');
        return $id;
    }
}