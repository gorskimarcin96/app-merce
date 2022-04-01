<?php

namespace App\Tests\HTTP;

use App\HTTP\Auth\JWTAllegro;
use App\HTTP\Factory\Response;
use App\HTTP\HTTP;
use PHPUnit\Framework\TestCase;

class HTTPTest extends TestCase
{
    protected function setUp(): void
    {
        $this->responseFactory = new Response();

        parent::setUp();
    }

    public function testGet()
    {
        $http = $this->createMock(HTTP::class);
        $http
            ->expects($this->once())
            ->method('get')
            ->willReturn($this->responseFactory->createResponse(200, 'Get method is ok.'));

        $response = $http->get('example.com', 'get data', ['get header']);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('Get method is ok.', $response->getReasonPhrase());
    }

    public function testPost()
    {
        $http = $this->createMock(HTTP::class);
        $http
            ->expects($this->once())
            ->method('post')
            ->willReturn($this->responseFactory->createResponse(201, 'Post method is ok.'));

        $response = $http->post('example.com', 'post data');

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Post method is ok.', $response->getReasonPhrase());
    }

    public function testPatch()
    {
        $http = $this->createMock(HTTP::class);
        $http
            ->expects($this->once())
            ->method('patch')
            ->willReturn($this->responseFactory->createResponse(200, 'Patch method is ok.'));

        $response = $http->patch('example.com', 'patch data');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('Patch method is ok.', $response->getReasonPhrase());
    }

    public function testPut()
    {
        $http = $this->createMock(HTTP::class);
        $http
            ->expects($this->once())
            ->method('put')
            ->willReturn($this->responseFactory->createResponse(200, 'Put method is ok.'));

        $response = $http->put('example.com', 'put data');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('Put method is ok.', $response->getReasonPhrase());
    }

    public function testDelete()
    {
        $http = $this->createMock(HTTP::class);
        $http
            ->expects($this->once())
            ->method('delete')
            ->willReturn($this->responseFactory->createResponse(200, 'Delete method is ok.'));

        $response = $http->delete('example.com', 'delete data');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('Delete method is ok.', $response->getReasonPhrase());
    }
}
