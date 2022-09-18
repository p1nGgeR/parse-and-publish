<?php

namespace App\Parser;

use App\Dto\ArticleDto;
use App\Entity\Source;
use App\Entity\SourceParsingError;
use App\Repository\SourceParsingErrorRepository;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SourceParser
{
    public function __construct(
        private HttpClientInterface          $httpClient,
        private SourceParsingErrorRepository $parsingErrorRepository,
    )
    {
    }

    /**
     * @return ArticleDto[]
     */
    public function parseArticles(Source $source): array
    {

        $lastError = $this->parsingErrorRepository->findOneBy([
            'source' => $source,
            'resolved' => false,
        ]);

        // do not parse until the error is resolved
        if (!is_null($lastError)) {
            return [];
        }

        $parsed = [];

        try {

        dd($this->httpClient->request(Request::METHOD_GET, $source->getUrl()));
            $crawler = new Crawler(null);
        } catch (\Throwable $exception) {
            $this->parsingErrorRepository->add(new SourceParsingError($exception->getMessage(), $source), true);
        }

        return $parsed;
    }
}
