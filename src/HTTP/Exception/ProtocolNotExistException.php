<?php

namespace App\HTTP\Exception;

use Exception;

class ProtocolNotExistException extends Exception
{
    public function __construct(string $version)
    {
        parent::__construct(sprintf('Protocol %s is not exists.', $version));
    }
}