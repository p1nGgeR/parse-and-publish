<?php

namespace App\Parser;

use App\Dto\ArticleDto;
use App\Entity\Source;
use App\Entity\SourceParsingError;
use App\Repository\SourceParsingErrorRepository;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Panther\Client;

class SourceParser
{
    public function __construct(
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
            $client = Client::createChromeClient();
            $sourceHost = parse_url($source->getUrl(), PHP_URL_HOST);

//            if (!is_null($source->getCookieName()) && !is_null($source->getCookieValue())) {
//                $cookie = new Cookie(
//                    $source->getCookieName(),
//                    $source->getCookieValue(),
//                    path: "/",
//                    domain: ".manutd.com",
//                );
//                $client->getCookieJar()->set($cookie);
//            }

            $client->request(Request::METHOD_GET, $source->getUrl());
            $crawler = $client->waitForVisibility('#accept-btn');
            $crawler->filter('#accept-btn')->click();
            $client->takeScreenshot('screen.png');

            $crawler = $crawler->filter($source->getArticleListSelector());

            foreach ($crawler->children($source->getArticleSelector()) as $item) {
                $url = $this->getElement($item, $source->getLinkSelector())?->getAttribute("href") ?: null;

                if (\is_null($url) || parse_url($url, PHP_URL_HOST) !== $sourceHost) {
                    continue;
                }

                $title = $this->getElement($item, $source->getTitleSelector())
                    ?->getText() ?: "";

                $description = $this->getElement($item, $source->getDescriptionSelector())
                    ?->getText() ?: null;

                $imageUrl = $this->getElement($item, $source->getImageSelector())
                    ?->getAttribute('src') ?: null;

                $parsed[] = new ArticleDto($url, $title, $description, $imageUrl);
            }
        } catch (\Throwable $exception) {
            $this->parsingErrorRepository->add(new SourceParsingError($exception->getMessage(), $source), true);
        }

        return $parsed;
    }

    private function getElement(RemoteWebElement $element, string $selector): ?RemoteWebElement
    {
        try {
            return $element->findElement(WebDriverBy::cssSelector($selector));
        } catch (NoSuchElementException $exception) {
            return null;
        }
    }
}
