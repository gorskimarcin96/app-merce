<?php

namespace App\Tests\HTTP;

use App\Faker\Invoker;
use App\HTTP\CURL;
use PHPUnit\Framework\TestCase;

class CURLTest extends TestCase
{
    use Invoker;

    public function testExecute()
    {
        $curl = new CURL();
        $curl->execute([
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => 'example.com'
        ]);

        $this->assertTrue(true);
    }

    public function testGetResult()
    {
        $curl = new CURL();
        $this->invokeProperties($curl, ['result' => 'test']);

        $this->assertSame('test', $curl->getResult());
    }

    public function testGetHttpCode()
    {
        $curl = new CURL();
        $this->invokeProperties($curl, ['httpCode' => 201]);

        $this->assertSame(201, $curl->getHttpCode());
    }
}
