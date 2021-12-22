<?php

namespace App\API\Domain\Article\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUpdateArticleModel
{
    /**
     * @Assert\NotBlank(message = "Title is required.")
     */
    private string $title;

    /**
     * @Assert\NotNull(message = "UserId is required.")
     */
    private int $userId;

    private bool $published;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     */
    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }
}
