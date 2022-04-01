<?php

namespace App\HTTP\Model;

use App\HTTP\Factory\Stream as StreamFactory;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractMessage implements MessageInterface
{
    protected array $headers = [];
    protected Protocol $protocol;
    protected StreamInterface $body;
    protected StreamFactory $streamFactory;

    public function __construct()
    {
        $this->protocol = new Protocol();
        $this->streamFactory = new StreamFactory();
    }

    public function getProtocolVersion(): string
    {
        return $this->protocol->getVersion();
    }

    public function withProtocolVersion($version): AbstractMessage|static
    {
        $this->protocol->setVersion($version);

        return $this;
    }

    public function getHeaders(): array
    {
        foreach ($this->headers as $name => $values) {
            $headers[] = $name . ": " . implode(", ", $values);
        }

        return $headers ?? [];
    }

    public function hasHeader($name): bool
    {
        return isset($this->headers[$name]);
    }

    public function getHeader($name): array
    {
        return $this->headers[$name] ?? [];
    }

    public function getHeaderLine($name): string
    {
        return isset($this->headers[$name]) ? implode(', ', $this->headers[$name]) : '';
    }

    public function withHeader($name, $value): AbstractMessage|static
    {
        $this->headers[$name] = [$value];

        return $this;
    }

    public function withAddedHeader($name, $value): AbstractMessage|static
    {
        $this->headers[$name][] = $value;

        return $this;
    }

    public function withoutHeader($name): AbstractMessage|static
    {
        unset($this->headers[$name]);
        
        return $this;
    }

    public function getBody(): StreamInterface
    {
        return $this->body ?? $this->streamFactory->createStream();
    }

    public function withBody(StreamInterface $body): AbstractMessage|static
    {
        $this->body = $body;

        return $this;
    }
}