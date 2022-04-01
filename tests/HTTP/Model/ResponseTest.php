<?php

namespace App\Tests\HTTP\Model;

use App\HTTP\Factory\Request;
use App\HTTP\Factory\Response as ResponseFactory;
use App\HTTP\Model\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testWithStatus()
    {
        $responseFactory = new ResponseFactory();
        $response = $responseFactory->createResponse();
        $response->withStatus(201, 'Post created.');

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Post created.', $response->getReasonPhrase());
    }

    public function testGetStatusCode()
    {
        $responseFactory = new ResponseFactory();
        $response = $responseFactory->createResponse(201, 'Post created.');

        $this->assertSame(201, $response->getStatusCode());
    }

    public function testGetReasonPhrase()
    {
        $responseFactory = new ResponseFactory();
        $response = $responseFactory->createResponse(201, 'Post created.');

        $this->assertSame('Post created.', $response->getReasonPhrase());
    }
}
