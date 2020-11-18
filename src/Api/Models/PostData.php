<?php

namespace Barya\Stats\Api\Models;


use \LazyJsonMapper\LazyJsonMapper;

/**
 * PostData.
 *
 * @method int getPage()
 * @method Post[] getPosts()
 * @method bool isPage()
 * @method bool isPosts()
 * @method $this setPage(int $value)
 * @method $this setPosts(Post[] $value)
 * @method $this unsetPage()
 * @method $this unsetPosts()
 *
 * @property int $page
 * @property Post[] $posts
 */
class PostData extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'page' => 'int',
        'posts' => 'Post[]'
    ];
}
