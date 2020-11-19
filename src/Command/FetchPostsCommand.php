<?php
declare(strict_types=1);

namespace Barya\Stats\Command;

use Barya\Stats\Exception\PostsNotSavedException;
use Barya\Stats\Service\PostFetcherInterface;
use Barya\Stats\Storage\PostStorageInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class FetchPostsCommand extends Command
{
    protected static $defaultName = 'app:fetch-posts';

    private PostFetcherInterface $fetcher;

    private PostStorageInterface $storage;

    private const ARG_START_PAGE = 'startPage';

    public function __construct(PostFetcherInterface $fetcher, PostStorageInterface $storage) {
        parent::__construct();
        $this->fetcher = $fetcher;
        $this->storage = $storage;
    }

    protected function configure() {
        $this->addArgument(self::ARG_START_PAGE, InputArgument::OPTIONAL, 'Start Page', 1);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $currentPage = (int) $input->getArgument(self::ARG_START_PAGE);
        $this->fetcher->setPage($currentPage);
        try {
            do {
                $currentPage = $this->fetcher->getPage();
                $posts = $this->fetcher->fetchPosts();
                $this->storage->bulkSave($posts);
            } while ($posts !== null);
        } catch (PostsNotSavedException $e) {
            $output->writeln(sprintf('Posts from page %s were not saved due to: %s', $currentPage, $e->getMessage()));
            $output->writeln('Fetching has been stopped');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

}
