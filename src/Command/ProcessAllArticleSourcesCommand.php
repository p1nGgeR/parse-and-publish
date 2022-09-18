<?php

namespace App\Command;

use App\Processor\ArticleSourceProcessor;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:process-all-article-sources',
    description: 'Processes all article sources',
)]
class ProcessAllArticleSourcesCommand extends Command
{

    public function __construct(private ArticleSourceProcessor $articleSourceProcessor)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->articleSourceProcessor->processAll();
            $io->success('All the article sources were processed.');

            return Command::SUCCESS;
        } catch (\Throwable $exception) {
            $io->error("Unexpected error occurred during processing article sources: {$exception->getMessage()}");

            return Command::FAILURE;
        }
    }
}
