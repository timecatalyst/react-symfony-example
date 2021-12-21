<?php

namespace App\API\Domain\Article\Command\DeleteArticle;

class DeleteArticleCommand
{
    private int $articleId;

    public function __construct(int $articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }
}
