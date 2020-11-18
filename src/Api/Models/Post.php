<?php

namespace Barya\Stats\Api\Models;


use LazyJsonMapper\LazyJsonMapper;

/**
 * Post.
 *
 * @method string getCreatedTime()
 * @method string getFromId()
 * @method string getFromName()
 * @method string getId()
 * @method string getMessage()
 * @method string getType()
 * @method bool isCreatedTime()
 * @method bool isFromId()
 * @method bool isFromName()
 * @method bool isId()
 * @method bool isMessage()
 * @method bool isType()
 * @method $this setCreatedTime(string $value)
 * @method $this setFromId(string $value)
 * @method $this setFromName(string $value)
 * @method $this setId(string $value)
 * @method $this setMessage(string $value)
 * @method $this setType(string $value)
 * @method $this unsetCreatedTime()
 * @method $this unsetFromId()
 * @method $this unsetFromName()
 * @method $this unsetId()
 * @method $this unsetMessage()
 * @method $this unsetType()
 *
 * @property string $created_time
 * @property string $from_id
 * @property string $from_name
 * @property string $id
 * @property string $message
 * @property string $type
 */
class Post extends LazyJsonMapper
{
    public const JSON_PROPERTY_MAP = [
        'id' => 'string',
        'from_name' => 'string',
        'from_id' => 'string',
        'message' => 'string',
        'type' => 'string',
        'created_time' => 'string'
    ];
}
