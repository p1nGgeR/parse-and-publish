<?php

namespace App\Processor;

use App\Creator\ArticleCreator;
use App\Entity\Source;
use App\Parser\SourceParser;
use App\Repository\SourceRepository;
use Psr\Log\LoggerInterface;

class ArticleSourceProcessor
{
    public function __construct(
        private SourceParser     $sourceParser,
        private SourceRepository $sourceRepository,
        private ArticleCreator   $articleCreator,
        private LoggerInterface  $logger,
    )
    {
    }

    public function processAll(): void
    {
        $sources = $this->sourceRepository->findBy(['enabled' => true]);

        foreach ($sources as $source) {
            $this->process($source);
        }
    }

    public function process(Source $source): void
    {
        if (!$source->isEnabled()) {
            return;
        }

        try {
            $parsedArticles = $this->sourceParser->parseArticles($source);

            if (count($parsedArticles) > 0) {
                $this->articleCreator->createParsedFromSource($source, $parsedArticles);
            }
        } catch (\Throwable $exception) {
            $this->logger->critical("Unexpected exception during the source processing", [
                'source' => $source->getId(),
                'exception' => $exception->getMessage(),
            ]);
        }
    }
}
