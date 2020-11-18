<?php

namespace Barya\Stats\Api\Models;


use LazyJsonMapper\LazyJsonMapper;

/**
 * PostResponse.
 *
 * @method PostData getData()
 * @method Error getError()
 * @method Meta getMeta()
 * @method bool isData()
 * @method bool isError()
 * @method bool isMeta()
 * @method $this setData(PostData $value)
 * @method $this setError(Error $value)
 * @method $this setMeta(Meta $value)
 * @method $this unsetData()
 * @method $this unsetError()
 * @method $this unsetMeta()
 *
 * @property PostData $data
 * @property Error $error
 * @property Meta $meta
 */
class PostResponse extends LazyJsonMapper
{
    public const JSON_PROPERTY_MAP = [
        'meta' => 'Meta',
        'data' => 'PostData',
        'error' => 'Error'
    ];
}
