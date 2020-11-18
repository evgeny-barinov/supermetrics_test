<?php
declare(strict_types=1);

namespace Barya\Stats\Api;


use Barya\Stats\Api\Models\Post;
use Barya\Stats\Service\PostFetcherInterface;

class PostFetcher implements PostFetcherInterface
{
    private CachingClient $client;

    private int $page = 1;

    private bool $completed = false;

    public function __construct(CachingClient $client) {
        $this->client = $client;
        $this->client->register();
    }

    /**
     * @return Post[]|null
     */
    public function fetchPosts() {
        if ($this->completed) {
            return null;
        }

        $response = $this->client->getPosts($this->page);
        $data = $response->getData();

        if ($data->getPage() < $this->page) {
            $this->completed;
            return null;
        }

        $this->page++;
        return $data->getPosts();
    }

    public function getPage(): int {
        return $this->page;
    }

    public function setPage(int $page): void {
        $this->page = $page;
    }

    public function reset(): void {
        $this->page = 1;
        $this->completed = false;
    }
}
