<?php

namespace App\Entity;

use App\Repository\SourceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SourceRepository::class)]
class Source
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name = "";

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 50, nullable: false)]
    private string $articleListSelector = "";

    #[ORM\Column(length: 50, nullable: false)]
    private string $articleSelector = "";

    #[ORM\Column(length: 50, nullable: false)]
    private string $titleSelector = "";

    #[ORM\Column(length: 50, nullable: false)]
    private string $descriptionSelector = "";

    #[ORM\Column(length: 50, nullable: false)]
    private string $linkSelector = "";

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $imageSelector = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $cookieName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cookieValue = null;

    #[ORM\Column(nullable: false, options: ["default" => 0])]
    private bool $enabled = false;

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getArticleListSelector(): string
    {
        return $this->articleListSelector;
    }

    public function setArticleListSelector(string $articleListSelector): self
    {
        $this->articleListSelector = $articleListSelector;

        return $this;
    }

    public function getArticleSelector(): ?string
    {
        return $this->articleSelector;
    }

    public function setArticleSelector(string $articleSelector): self
    {
        $this->articleSelector = $articleSelector;

        return $this;
    }

    public function getTitleSelector(): string
    {
        return $this->titleSelector;
    }

    public function setTitleSelector(string $titleSelector): self
    {
        $this->titleSelector = $titleSelector;

        return $this;
    }

    public function getDescriptionSelector(): ?string
    {
        return $this->descriptionSelector;
    }

    public function setDescriptionSelector(string $descriptionSelector): self
    {
        $this->descriptionSelector = $descriptionSelector;

        return $this;
    }

    public function getLinkSelector(): string
    {
        return $this->linkSelector;
    }

    public function setLinkSelector(string $linkSelector): self
    {
        $this->linkSelector = $linkSelector;

        return $this;
    }

    public function getImageSelector(): ?string
    {
        return $this->imageSelector;
    }

    public function setImageSelector(string $imageSelector): self
    {
        $this->imageSelector = $imageSelector;

        return $this;
    }

    public function getCookieName(): ?string
    {
        return $this->cookieName;
    }

    public function setCookieName(string $cookieName): self
    {
        $this->cookieName = $cookieName;

        return $this;
    }

    public function getCookieValue(): ?string
    {
        return $this->cookieValue;
    }

    public function setCookieValue(string $cookieValue): self
    {
        $this->cookieValue = $cookieValue;

        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}
