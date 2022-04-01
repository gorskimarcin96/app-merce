<?php

namespace App\HTTP\Model;

use App\HTTP\Exception\ProtocolNotExistException;

class Protocol
{
    public const VERSION_1_0 = '1.0';
    public const VERSION_1_1 = '1.1';

    private string $version;

    public function __construct(string $version = self::VERSION_1_1)
    {
        $this->setVersion($version);
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version)
    {
        if (!in_array($version, [self::VERSION_1_0, self::VERSION_1_1])) {
            throw new ProtocolNotExistException($version);
        }

        $this->version = $version;
    }
}