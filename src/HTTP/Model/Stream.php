<?php

namespace App\HTTP\Model;

use Exception;
use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function __toString(): string
    {
        return $this->content;
    }

    public function close(): void
    {
        throw new Exception('This method is not implemented');
    }

    public function detach()
    {
        throw new Exception('This method is not implemented');
    }

    public function getSize(): ?int
    {
        throw new Exception('This method is not implemented');
    }

    public function tell(): int
    {
        throw new Exception('This method is not implemented');
    }

    public function eof(): bool
    {
        throw new Exception('This method is not implemented');
    }

    public function isSeekable(): bool
    {
        throw new Exception('This method is not implemented');
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        throw new Exception('This method is not implemented');
    }

    public function rewind()
    {
        throw new Exception('This method is not implemented');
    }

    public function isWritable(): bool
    {
        throw new Exception('This method is not implemented');
    }

    public function write($string): int
    {
        throw new Exception('This method is not implemented');
    }

    public function isReadable(): bool
    {
        throw new Exception('This method is not implemented');
    }

    public function read($length): string
    {
        throw new Exception('This method is not implemented');
    }

    public function getContents(): string
    {
        return $this->content;
    }

    public function getMetadata($key = null): mixed
    {
        throw new Exception('This method is not implemented');
    }
}