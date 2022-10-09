<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Source $source = null;

    #[ORM\Column(length: 255, nullable: false)]
    private string $url = "";

    #[ORM\Column(length: 255, nullable: false)]
    private string $title = "";

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private string $description = "";

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(nullable: false)]
    private \DateTimeImmutable $parsedAt;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleTelegramPublication::class, orphanRemoval: true)]
    private Collection $telegramPublications;

    public function __construct()
    {
        $this->parsedAt = new \DateTimeImmutable();
        $this->telegramPublications = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(Source $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getParsedAt(): \DateTimeImmutable
    {
        return $this->parsedAt;
    }

    public function setParsedAt(\DateTimeImmutable $parsedAt): self
    {
        $this->parsedAt = $parsedAt;

        return $this;
    }

    /**
     * @return Collection<int, ArticleTelegramPublication>
     */
    public function getTelegramPublications(): Collection
    {
        return $this->telegramPublications;
    }

    public function addTelegramPublication(ArticleTelegramPublication $telegramPublication): self
    {
        if (!$this->telegramPublications->contains($telegramPublication)) {
            $this->telegramPublications->add($telegramPublication);
            $telegramPublication->setArticle($this);
        }

        return $this;
    }

    public function removeTelegramPublication(ArticleTelegramPublication $telegramPublication): self
    {
        if ($this->telegramPublications->removeElement($telegramPublication)) {
            if ($telegramPublication->getArticle() === $this) {
                $telegramPublication->setArticle(null);
            }
        }

        return $this;
    }
}
