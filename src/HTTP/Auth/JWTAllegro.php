<?php

namespace App\HTTP\Auth;

use Psr\Http\Message\RequestInterface;

class JWTAllegro implements AuthInterface
{
    public function __construct(private string $token)
    {
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function authRequest(RequestInterface $request): RequestInterface
    {
        return $request
            ->withAddedHeader('Authorization', 'Bearer ' . $this->getToken())
            ->withAddedHeader('Accept','application/vnd.allegro.public.v1+json');
    }
}