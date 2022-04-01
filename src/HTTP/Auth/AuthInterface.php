<?php

namespace App\HTTP\Auth;

use Psr\Http\Message\RequestInterface;

interface AuthInterface
{
    public function authRequest(RequestInterface $request): RequestInterface;
}