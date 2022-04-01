<?php

namespace App\Tests\HTTP\Factory;

use App\HTTP\Factory\Stream;
use App\HTTP\Model\Stream as Model;
use PHPUnit\Framework\TestCase;

class StreamTest extends TestCase
{
    public function testCreateStream()
    {
        $streamFactory = new Stream();
        $stream = $streamFactory->createStream('{"name":"test"}');

        $this->assertInstanceOf(Model::class, $stream);
        $this->assertSame('{"name":"test"}', $stream->getContents());
    }

    public function testCreateStreamFromFile()
    {
        $streamFactory = new Stream();
        $stream = $streamFactory->createStreamFromFile(__dir__ . '/test.json');

        $this->assertInstanceOf(Model::class, $stream);
        $this->assertSame('{"name":"test"}', $stream->getContents());
    }

    public function testCreateStreamFromResource()
    {
        $stream = fopen('php://memory','r+');
        fwrite($stream, '{"name":"test"}');
        rewind($stream);

        $streamFactory = new Stream();
        $stream = $streamFactory->createStreamFromResource($stream);

        $this->assertInstanceOf(Model::class, $stream);
        $this->assertSame('{"name":"test"}', $stream->getContents());
    }
}
