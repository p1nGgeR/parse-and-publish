<?php

namespace App\Entity;

use App\Repository\TelegramPublicationErrorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelegramPublicationErrorRepository::class)]
class TelegramPublicationError extends AbstractError
{
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TelegramChannel $channel = null;

    public function __toString(): string
    {
        return "{$this->getChannel()}: {$this->getReason()}";
    }

    public function getChannel(): ?TelegramChannel
    {
        return $this->channel;
    }

    public function setChannel(?TelegramChannel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }
}
