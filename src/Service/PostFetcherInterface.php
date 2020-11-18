<?php
declare(strict_types=1);

namespace Barya\Stats\Service;

use Barya\Stats\Api\Models\Post;
use Barya\Stats\Common\PaginatedInterface;

interface PostFetcherInterface extends PaginatedInterface
{
    /**
     * @return Post[]|null
     */
    public function fetchPosts();
}
