<?php

namespace App\API\Domain\Article\Command\CreateArticle;

use App\API\Domain\Article\DTO\CreateUpdateArticleModel;

class CreateArticleCommand
{
    private CreateUpdateArticleModel $model;

    public function __construct(CreateUpdateArticleModel $model)
    {
        $this->model = $model;
    }

    /**
     * @return CreateUpdateArticleModel
     */
    public function getModel(): CreateUpdateArticleModel
    {
        return $this->model;
    }
}
