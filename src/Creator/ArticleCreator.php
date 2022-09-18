<?php

namespace App\Creator;

use App\Dto\ArticleDto;
use App\Entity\Article;
use App\Entity\Source;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleCreator
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private EntityManagerInterface $em,
    )
    {
    }

    public function create(Source $source,  ArticleDto $articleDto): Article
    {
        $article = $this->articleRepository->findOneBy([
            'source' => $source,
            'url' => $articleDto->url,
        ]);

        if ($article) {
            return $article;
        }

        $article = new Article();

        $article->setSource($source);
        $article->setUrl($articleDto->url);
        $article->setTitle($articleDto->title);
        $article->setDescription($articleDto->description);
        $article->setImageUrl($articleDto->imageUrl);

        $this->em->persist($article);

        return $article;
    }

    public function createAndSave(Source $source,  ArticleDto $articleDto): Article
    {
        $article = $this->create(...func_get_args());

        $this->em->flush();

        return $article;
    }

    /**
     * @param ArticleDto[] $articleDtos
     */
    public function createParsedFromSource(Source $source, array $articleDtos): void
    {
        foreach (array_chunk($articleDtos, 100) as $chunk) {
            /** @var ArticleDto $articleDto */
            foreach ($chunk as $articleDto) {
                $this->create($source, $articleDto);
            }

            $this->em->flush();
        }
    }
}
