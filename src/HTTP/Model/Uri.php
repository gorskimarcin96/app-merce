<?php

namespace App\HTTP\Model;

use Exception;
use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    private string $scheme = '';
    private string $host;
    private ?int $port = null;
    private string $path;
    private string $query;
    private string $fragment;
    private string $user = '';
    private ?string $password = null;

    public function __construct(?string $url = null)
    {
        if ($url) {
            $parseUrl = parse_url($url);

            $this->scheme = $parseUrl['scheme'] ?? '';
            $this->host = $parseUrl['host'] ?? '';
            $this->port = $parseUrl['port'] ?? null;
            $this->path = $parseUrl['path'] ?? '';
            $this->query = $parseUrl['query'] ?? '';
            $this->fragment = $parseUrl['fragment'] ?? '';
        }
    }

    public function __toString(): string
    {
        return $this->buildUrl();
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getAuthority(): string
    {
        $authority = $this->user ? ($this->user . '@' . $this->host) : $this->host;
        $authority .= $this->port !== null ? (':' . $this->port) : '';

        return $authority;
    }

    public function getUserInfo(): string
    {
        return $this->user;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getFragment(): string
    {
        return $this->fragment;
    }

    public function withScheme($scheme): Uri|static
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function withUserInfo($user, $password = null): Uri|static
    {
        $this->user = $user;

        return $this;
    }

    public function withHost($host): Uri|static
    {
        $this->host = $host;

        return $this;
    }

    public function withPort($port): Uri|static
    {
        $this->port = $port;

        return $this;
    }

    public function withPath($path): Uri|static
    {
        $this->path = $path;

        return $this;
    }

    public function withQuery($query): Uri|static
    {
        $this->query = $query;

        return $this;
    }

    public function withFragment($fragment): Uri|static
    {
        $this->fragment = $fragment;

        return $this;
    }

    public function setPath(mixed $requestTarget): static
    {
        $this->path = $requestTarget;

        return $this;
    }

    private function buildUrl(): string
    {
        return $this->scheme . '://' .
            $this->host .
            $this->port .
            $this->path .
            ($this->query ? ('?' . $this->query) : '') .
            ($this->fragment ? ('#' . $this->fragment) : '');
    }
}