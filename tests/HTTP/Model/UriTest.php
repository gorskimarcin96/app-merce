<?php

namespace App\Tests\HTTP\Model;

use App\HTTP\Factory\Uri as UriFactory;
use PHPUnit\Framework\TestCase;

class UriTest extends TestCase
{
    protected function setUp(): void
    {
        $uriFactory = new UriFactory();
        $this->uri = $uriFactory->createUri('https://www.google.com:81/dir/1/2/search.html?arg=0-a&arg1=1-b&arg3-c#hash');

        parent::setUp();
    }

    public function testGetPath()
    {
        $this->assertSame('/dir/1/2/search.html', $this->uri->getPath());
    }

    public function testSetPath()
    {
        $this->uri->setPath('test');

        $this->assertSame('test', $this->uri->getPath());
    }

    public function testWithPath()
    {
        $this->uri->withPath('test');

        $this->assertSame('test', $this->uri->getPath());
    }

    public function testGetQuery()
    {
        $this->assertSame('arg=0-a&arg1=1-b&arg3-c', $this->uri->getQuery());
    }

    public function testWithQuery()
    {
        $this->uri->withQuery('key=value');

        $this->assertSame('key=value', $this->uri->getQuery());
    }

    public function testGetPort()
    {
        $this->assertSame(81, $this->uri->getPort());
    }

    public function testWithPort()
    {
        $this->uri->withPort(82);

        $this->assertSame(82, $this->uri->getPort());
    }

    public function testWithHost()
    {
        $this->uri->withHost('example.com');

        $this->assertSame('example.com', $this->uri->getHost());
    }

    public function testGetHost()
    {
        $this->assertSame('www.google.com', $this->uri->getHost());
    }

    public function testWithFragment()
    {
        $this->uri->withFragment('test');

        $this->assertSame('test', $this->uri->getFragment());
    }

    public function testGetFragment()
    {
        $this->assertSame('hash', $this->uri->getFragment());
    }

    public function testWithScheme()
    {
        $this->uri->withScheme('http');

        $this->assertSame('http', $this->uri->getScheme());
    }

    public function testGetScheme()
    {
        $this->assertSame('https', $this->uri->getScheme());
    }

    public function testGetAuthority()
    {
        $this->assertSame('www.google.com:81', $this->uri->getAuthority());

        $this->uri->withUserInfo('test');
        $this->assertSame('test@www.google.com:81', $this->uri->getAuthority());
    }

    public function testWithUserInfo()
    {
        $this->uri->withUserInfo('test');

        $this->assertSame('test', $this->uri->getUserInfo());
    }

    public function testGetUserInfo()
    {
        $this->assertSame('', $this->uri->getUserInfo());
    }
}
