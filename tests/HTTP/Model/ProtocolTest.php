<?php

namespace App\Tests\HTTP\Model;

use App\HTTP\Exception\ProtocolNotExistException;
use App\HTTP\Model\Protocol;
use PHPUnit\Framework\TestCase;

class ProtocolTest extends TestCase
{
    public function testGetVersion()
    {
        $protocol = new Protocol();

        $this->assertSame('1.1', $protocol->getVersion());
    }

    public function testSetVersion()
    {
        $protocol = new Protocol();
        $protocol->setVersion(Protocol::VERSION_1_0);

        $this->assertSame('1.0', $protocol->getVersion());
    }

    public function testSetVersionException()
    {
        $this->expectExceptionMessage('Protocol -1 is not exists.');
        $this->expectException(ProtocolNotExistException::class);

        new Protocol(-1);
    }
}
