<?php

namespace App\Tests\HTTP\Model;

use App\HTTP\Factory\Stream as StreamFactory;
use App\HTTP\Model\Stream;
use PHPUnit\Framework\TestCase;

class StreamTest extends TestCase
{
    public function testGetContents()
    {
        $streamFactory = new StreamFactory();
        $stream = $streamFactory->createStream('test');

        $this->assertSame('test', $stream->getContents());
    }
}
