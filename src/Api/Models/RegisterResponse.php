<?php

namespace Barya\Stats\Api\Models;


use LazyJsonMapper\LazyJsonMapper;


/**
 * RegisterResponse.
 *
 * @method RegisterData getData()
 * @method Error getError()
 * @method Meta getMeta()
 * @method bool isData()
 * @method bool isError()
 * @method bool isMeta()
 * @method $this setData(RegisterData $value)
 * @method $this setError(Error $value)
 * @method $this setMeta(Meta $value)
 * @method $this unsetData()
 * @method $this unsetError()
 * @method $this unsetMeta()
 *
 * @property RegisterData $data
 * @property Error $error
 * @property Meta $meta
 */
class RegisterResponse extends LazyJsonMapper
{
    public const JSON_PROPERTY_MAP = [
        'meta' => 'Meta',
        'data' => 'RegisterData',
        'error' => 'Error'
    ];
}
