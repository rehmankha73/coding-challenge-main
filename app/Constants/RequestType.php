<?php

namespace App\Constants;

class RequestType
{
    public const PENDING ='pending';
    public const ACCEPTED ='accepted';
    public const COMPLETED ='completed';

    public const REQUEST_TYPES = [
        self::PENDING,
        self::ACCEPTED,
        self::COMPLETED,
    ];
}
