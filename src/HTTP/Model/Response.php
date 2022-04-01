<?php

namespace App\HTTP\Model;

use Psr\Http\Message\ResponseInterface;

class Response extends AbstractMessage implements ResponseInterface
{
    private HttpCode $httpCode;

    public function __construct()
    {
        $this->httpCode = new HttpCode();

        parent::__construct();
    }

    public function getStatusCode(): int
    {
        return $this->httpCode->getStatusCode();
    }

    public function withStatus($code, $reasonPhrase = ''): Response|static
    {
        $this->httpCode->withHttpCode($code, $reasonPhrase);

        return $this;
    }

    public function getReasonPhrase(): string
    {
        return $this->httpCode->getReasonPhrase();
    }
}