<?php

namespace App\Tests\HTTP\Factory;

use App\HTTP\Model\Request as Model;
use App\HTTP\Factory\Request;
use App\HTTP\Factory\Uri;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testCreateRequest()
    {
        $requestFactory = new Request();
        $uriFactory = new Uri();
        $request = $requestFactory->createRequest('GET', $uriFactory->createUri('https://www.example.com'));

        $this->assertInstanceOf(Model::class, $request);
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://www.example.com', $request->getUri()->__toString());
    }
}
