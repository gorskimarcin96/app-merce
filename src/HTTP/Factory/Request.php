<?php

namespace App\HTTP\Factory;

use App\HTTP\Model\Request as Model;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

class Request implements RequestFactoryInterface
{
    public function createRequest(string $method, $uri): RequestInterface
    {
        $request = new Model();

        return $request->withUri($uri)->withMethod($method);
    }
}