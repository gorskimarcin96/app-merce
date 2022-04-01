<?php

namespace App\Tests\HTTP\Model;

use App\Faker\Invoker;
use App\HTTP\Model\HttpCode;
use PHPUnit\Framework\TestCase;

class HttpCodeTest extends TestCase
{
    use Invoker;

    public function testWithHttpCode()
    {
        $httpCode = new HttpCode();
        $httpCode->withHttpCode(201, 'Post created.');

        $this->assertSame(201, $httpCode->getStatusCode());
        $this->assertSame('Post created.', $httpCode->getReasonPhrase());
    }

    public function testGetStatusCode()
    {
        $httpCode = new HttpCode();
        $this->invokeProperties($httpCode, ['code' => 200]);

        $this->assertSame(200, $httpCode->getStatusCode());
    }

    public function testGetReasonPhrase()
    {
        $httpCode = new HttpCode();
        $this->invokeProperties($httpCode, ['reasonPhrase' => 'test']);

        $this->assertSame('test', $httpCode->getReasonPhrase());
    }
}
