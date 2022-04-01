<?php

namespace App\HTTP\Model;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class Request extends AbstractMessage implements RequestInterface
{
    private Uri $uri;
    private string $method;
    private array $curlOptions = [];

    public function __construct()
    {
        $this->uri = new Uri();

        parent::__construct();
    }

    public function getRequestTarget(): string
    {
        return $this->uri->getPath();
    }

    public function withRequestTarget($requestTarget): static|Request
    {
        $this->uri->setPath($requestTarget);

        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function withMethod($method): static|Request
    {
        $this->method = $method;

        return $this;
    }

    public function getUri(): UriInterface|Uri
    {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, $preserveHost = false): static|Request
    {
        $this->uri = $uri;

        return $this;
    }
}