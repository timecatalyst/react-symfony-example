<?php

namespace App\API\Domain\Article\DTO;

use DateTime;

class ArticlesListItemModel
{
    private int $id;
    private string $title;
    private string $userName;
    private bool $published;
    private ?DateTime $publishedDate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
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

    /**
     * @return DateTime|null
     */
    public function getPublishedDate(): ?DateTime
    {
        return $this->publishedDate;
    }

    /**
     * @param DateTime|null $publishedDate
     */
    public function setPublishedDate(?DateTime $publishedDate): void
    {
        $this->publishedDate = $publishedDate;
    }
}