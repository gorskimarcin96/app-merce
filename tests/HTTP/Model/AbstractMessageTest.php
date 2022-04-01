<?php

namespace App\Tests\HTTP\Model;

use App\Faker\Invoker;
use App\HTTP\Model\AbstractMessage;
use App\HTTP\Model\Protocol;
use App\HTTP\Model\Request;
use PHPUnit\Framework\TestCase;

class AbstractMessageTest extends TestCase
{
    use Invoker;

    private AbstractMessage $abstractMessage;

    protected function setUp(): void
    {
        $this->abstractMessage = new class extends AbstractMessage {};

        parent::setUp();
    }

    public function testWithBody()
    {
        $this->assertSame('1.1', $this->abstractMessage->getProtocolVersion());
    }

    public function testHasHeader()
    {
        $this->invokeProperties($this->abstractMessage, ['headers' => ['name' => ['value']]]);

        $this->assertTrue($this->abstractMessage->hasHeader('name'));
        $this->assertFalse($this->abstractMessage->hasHeader('header'));
    }

    public function testGetHeaderLine()
    {
        $this->invokeProperties($this->abstractMessage, ['headers' => ['name' => ['value']]]);

        $this->assertSame('value', $this->abstractMessage->getHeaderLine('name'));
        $this->assertSame('', $this->abstractMessage->getHeaderLine('test'));
    }

    public function testGetHeader()
    {
        $this->invokeProperties($this->abstractMessage, ['headers' => ['name' => ['value']]]);

        $this->assertSame(['value'], $this->abstractMessage->getHeader('name'));
        $this->assertSame([], $this->abstractMessage->getHeader('test'));
    }

    public function testGetBody()
    {
        $this->assertSame('', $this->abstractMessage->getBody()->getContents());
    }

    public function testGetHeaders()
    {
        $this->invokeProperties($this->abstractMessage, ['headers' => [
            'header' => ['value'],
            'headers' => ['value1', 'value2'],
        ]]);

        $this->assertSame(['header: value', 'headers: value1, value2'], $this->abstractMessage->getHeaders());
    }

    public function testGetProtocolVersion()
    {
        $this->invokeProperties($this->abstractMessage, ['protocol' => new Protocol('1.0')]);

        $this->assertSame('1.0', $this->abstractMessage->getProtocolVersion());
    }

    public function testWithHeader()
    {
        $this->abstractMessage->withHeader('test', 'value1');
        $this->assertSame(['value1'], $this->abstractMessage->getHeader('test'));

        $this->abstractMessage->withHeader('test', 'value2');
        $this->assertSame(['value2'], $this->abstractMessage->getHeader('test'));
    }

    public function testWithAddedHeader()
    {
        $this->abstractMessage->withAddedHeader('test', 'value1');
        $this->assertSame(['value1'], $this->abstractMessage->getHeader('test'));

        $this->abstractMessage->withAddedHeader('test', 'value2');
        $this->assertSame(['value1', 'value2'], $this->abstractMessage->getHeader('test'));
    }

    public function testWithProtocolVersion()
    {
        $this->abstractMessage->withProtocolVersion('1.0');
        $this->assertSame('1.0', $this->abstractMessage->getProtocolVersion());
    }

    public function testWithoutHeader()
    {
        $this->abstractMessage->withHeader('test', 'value');
        $this->assertSame(['value'], $this->abstractMessage->getHeader('test'));

        $this->abstractMessage->withoutHeader('test');
        $this->assertSame([], $this->abstractMessage->getHeader('test'));
    }
}
