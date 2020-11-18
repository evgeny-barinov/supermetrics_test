<?php

namespace Barya\Stats\Api\Models;


use \LazyJsonMapper\LazyJsonMapper;

/**
 * RegisterData.
 *
 * @method string getClientId()
 * @method string getEmail()
 * @method string getSlToken()
 * @method bool isClientId()
 * @method bool isEmail()
 * @method bool isSlToken()
 * @method $this setClientId(string $value)
 * @method $this setEmail(string $value)
 * @method $this setSlToken(string $value)
 * @method $this unsetClientId()
 * @method $this unsetEmail()
 * @method $this unsetSlToken()
 *
 * @property string $client_id
 * @property string $email
 * @property string $sl_token
 */
class RegisterData extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'client_id' => 'string',
        'email' => 'string',
        'sl_token' => 'string'
    ];
}
