<?php

namespace App\HTTP\Model;

use Exception;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

class UploadedFile implements UploadedFileInterface
{
    public function getStream(): StreamInterface
    {
        throw new Exception('This method is not implemented');
    }

    public function moveTo($targetPath)
    {
        throw new Exception('This method is not implemented');
    }

    public function getSize(): ?int
    {
        throw new Exception('This method is not implemented');
    }

    public function getError(): int
    {
        throw new Exception('This method is not implemented');
    }

    public function getClientFilename():? string
    {
        throw new Exception('This method is not implemented');
    }

    public function getClientMediaType():? string
    {
        throw new Exception('This method is not implemented');
    }
}