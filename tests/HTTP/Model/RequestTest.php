<?php

namespace App\Tests\HTTP\Model;

use App\HTTP\Factory\Request as RequestFactory;
use App\HTTP\Factory\Uri;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    protected function setUp(): void
    {
        $uri = (new Uri())->createUri('https://www.google.com:81/dir/1/2/search.html?arg=0-a&arg1=1-b&arg3-c#hash');
        $this->request = (new RequestFactory())->createRequest('GET', $uri);

        parent::setUp();
    }

    public function testGetRequestTarget()
    {
        $this->assertSame('/dir/1/2/search.html', $this->request->getRequestTarget());
    }

    public function testWithMethod()
    {
        $this->request->withMethod('POST');

        $this->assertSame('POST', $this->request->getMethod());
    }

    public function testGetUri()
    {
        $this->assertSame('https', $this->request->getUri()->getScheme());
        $this->assertSame('www.google.com', $this->request->getUri()->getHost());
        $this->assertSame(81, $this->request->getUri()->getPort());
        $this->assertSame('/dir/1/2/search.html', $this->request->getUri()->getPath());
        $this->assertSame('arg=0-a&arg1=1-b&arg3-c', $this->request->getUri()->getQuery());
        $this->assertSame('hash', $this->request->getUri()->getFragment());
    }

    public function testWithUri()
    {
        $this->request->withUri((new Uri())->createUri('https://www.example.com'));

        $this->assertSame('https://www.example.com', $this->request->getUri()->__toString());
    }

    public function testWithRequestTarget()
    {
        $this->request->withRequestTarget('test');

        $this->assertSame('test', $this->request->getRequestTarget());
    }

    public function testGetMethod()
    {
        $this->assertSame('GET', $this->request->getMethod());
    }
}
