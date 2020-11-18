<?php

namespace Barya\Stats\Api\Models;


use LazyJsonMapper\LazyJsonMapper;

/**
 * Meta.
 *
 * @method string getRequestId()
 * @method bool isRequestId()
 * @method $this setRequestId(string $value)
 * @method $this unsetRequestId()
 *
 * @property string $request_id
 */
class Meta extends LazyJsonMapper
{
    public const JSON_PROPERTY_MAP = [
        'request_id' => 'string'
    ];
}
