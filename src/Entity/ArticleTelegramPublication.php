<?php

namespace App\Entity;

use App\Repository\ArticleTelegramPublicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleTelegramPublicationRepository::class)]
class ArticleTelegramPublication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'telegramPublications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TelegramChannel $telegramChannel = null;

    #[ORM\Column(length: 255)]
    private ?string $postedUrl = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $postedAt = null;

    public function __toString(): string
    {
        return $this->getPostedUrl();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getTelegramChannel(): ?TelegramChannel
    {
        return $this->telegramChannel;
    }

    public function setTelegramChannel(?TelegramChannel $telegramChannel): self
    {
        $this->telegramChannel = $telegramChannel;

        return $this;
    }

    public function getPostedUrl(): ?string
    {
        return $this->postedUrl;
    }

    public function setPostedUrl(string $postedUrl): self
    {
        $this->postedUrl = $postedUrl;

        return $this;
    }

    public function getPostedAt(): ?\DateTimeImmutable
    {
        return $this->postedAt;
    }

    public function setPostedAt(\DateTimeImmutable $postedAt): self
    {
        $this->postedAt = $postedAt;

        return $this;
    }
}
