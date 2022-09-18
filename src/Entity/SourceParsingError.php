<?php

namespace App\Entity;

use App\Repository\SourceParsingErrorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SourceParsingErrorRepository::class)]
class SourceParsingError extends AbstractError
{
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Source $source;

    public function __construct(string $reason, Source $source)
    {
        parent::__construct($reason);

        $this->source = $source;
    }

    public function __toString(): string
    {
        return "{$this->getSource()}: {$this->getReason()}";
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function setSource(Source $source): self
    {
        $this->source = $source;

        return $this;
    }
}
