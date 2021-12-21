<?php

namespace App\DAL\Entity;

use App\DAL\Repository\ArticleRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    private int $userId;

    /**
     * @ORM\ManyToOne(targetEntity="App\DAL\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTime $createdDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $published;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $publishedDate;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdDate = new DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Article
     */
    public function setUser(User $user): Article
    {
        $this->user = $user;
        return $this;
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
     * @return Article
     */
    public function setTitle(string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedDate(): DateTime
    {
        return $this->createdDate;
    }

    /**
     * @return DateTime|null
     */
    public function getPublishedDate(): ?DateTime
    {
        return $this->publishedDate;
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
     * @return Article
     */
    public function setPublished(bool $published): Article
    {
        $this->published = $published;
        return $this;
    }

    /**
     * @param DateTime|null $publishedDate
     * @return Article
     */
    public function setPublishedDate(?DateTime $publishedDate): Article
    {
        $this->publishedDate = $publishedDate;
        return $this;
    }
}