<?php

namespace App\HTTP\Factory;

use App\HTTP\Model\Stream as Model;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class Stream implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        return new Model($content);
    }

    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        $file = fopen($filename, $mode) ;
        $data = fread($file,filesize($filename));
        fclose($file);

        return new Model($data);
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        return new Model(stream_get_contents($resource));
    }
}