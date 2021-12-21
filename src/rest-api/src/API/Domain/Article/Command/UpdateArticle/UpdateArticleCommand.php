<?php

namespace App\API\Domain\Article\Command\UpdateArticle;

use App\API\Domain\Article\DTO\CreateUpdateArticleModel;

class UpdateArticleCommand
{
    private int $articleId;
    private CreateUpdateArticleModel $model;

    public function __construct(int $articleId, CreateUpdateArticleModel $model)
    {
        $this->articleId = $articleId;
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    /**
     * @return CreateUpdateArticleModel
     */
    public function getModel(): CreateUpdateArticleModel
    {
        return $this->model;
    }
}
