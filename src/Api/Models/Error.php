<?php

namespace Barya\Stats\Api\Models;


use LazyJsonMapper\LazyJsonMapper;

/**
 * Error.
 *
 * @method string getMessage()
 * @method bool isMessage()
 * @method $this setMessage(string $value)
 * @method $this unsetMessage()
 *
 * @property string $message
 */
class Error extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'message' => 'string'
    ];
}
