<?php

namespace App\HTTP\Factory;

use App\HTTP\Model\Response as Model;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class Response implements ResponseFactoryInterface
{
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        $response = new Model();

        return $response->withStatus($code, $reasonPhrase);
    }
}