<?php
declare(strict_types=1);

namespace Barya\Stats\Storage;


use Barya\Stats\Exception\PostsNotSavedException;
use Barya\Stats\Api\Models\Post;

interface PostStorageInterface {
    /**
     * @param Post[] $posts
     * @throws PostsNotSavedException
     */
    public function bulkSave(array $posts): bool;
}
