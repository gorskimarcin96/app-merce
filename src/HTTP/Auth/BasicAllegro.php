<?php

namespace App\HTTP\Auth;

use App\HTTP\Factory\Stream as StreamFactory;
use Psr\Http\Message\RequestInterface;

class BasicAllegro implements AuthInterface
{
    private StreamFactory $streamFactory;

    public function __construct(private string $user, private string $password)
    {
        $this->streamFactory = new StreamFactory();
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function authRequest(RequestInterface $request): RequestInterface
    {
        $authorization = base64_encode($this->getUser() . ':' . $this->getPassword());

        return $request
            ->withBody($this->streamFactory->createStream("client_id=" . $this->getUser()))
            ->withHeader('Authorization', 'Basic ' . $authorization)
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
}