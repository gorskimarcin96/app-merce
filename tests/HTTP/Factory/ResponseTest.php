<?php

namespace App\Tests\HTTP\Factory;

use App\HTTP\Factory\Response;
use App\HTTP\Model\Response as Model;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testCreateResponse()
    {
        $responseFactory = new Response();
        $response = $responseFactory->createResponse(200, 'test phrase');

        $this->assertInstanceOf(Model::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('test phrase', $response->getReasonPhrase());
    }
}
