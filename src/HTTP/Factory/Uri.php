<?php

namespace App\HTTP\Factory;

use App\HTTP\Model\Uri as Model;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

class Uri implements UriFactoryInterface
{
    public function createUri(string $uri = ''): UriInterface
    {
        return new Model($uri);
    }
}